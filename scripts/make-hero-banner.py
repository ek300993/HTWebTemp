"""Bake the home hero banner.

The hero needs a calm field on the left for the headline. Rather than lay a flat
panel over the photograph — which always shows as a seam somewhere, because the
picture goes sage at the top and warm wood at the bottom — the left of the band
is built out of the photograph itself: the same image blurred past recognition,
then veiled towards sand. The two sides can't disagree on colour, because they
are the same colours.

The dissolve edge is three sine waves at different frequencies summed and then
blurred, so it wanders instead of ruling a line.

Two modes:

  extend  the source is already a wide banner (the scene painted out to the left).
          It fills the canvas and only the dissolve and veil are applied.
  wide    the source is an ordinary portrait photo. It's placed at the right and
          the rest of the band is made from the wash.

Usage:
  python3 scripts/make-hero-banner.py SRC OUT WIDTH HEIGHT EDGE FEATHER MODE

EDGE is where the sharp picture starts, as a fraction of the width; FEATHER is
how far the dissolve reaches back from it, also as a fraction of the width.
"""
import math
import sys
from PIL import Image, ImageFilter, ImageDraw

SRC, OUT = sys.argv[1], sys.argv[2]
W, H = int(sys.argv[3]), int(sys.argv[4])
EDGE, FEATHER = float(sys.argv[5]), float(sys.argv[6])
MODE = sys.argv[7] if len(sys.argv) > 7 else 'extend'

SAND = (242, 236, 225)

photo = Image.open(SRC).convert('RGB')

# --- The wash -------------------------------------------------------------
wash = photo.resize((W, H), Image.LANCZOS).filter(
    ImageFilter.GaussianBlur(radius=max(W, H) * 0.11))

# --- The sharp picture ----------------------------------------------------
if MODE == 'extend':
    # Already the right shape: scale to cover and centre-crop the overflow.
    scale = max(W / photo.width, H / photo.height)
    sharp = photo.resize((round(photo.width * scale), round(photo.height * scale)),
                         Image.LANCZOS)
    sharp = sharp.crop(((sharp.width - W) // 2, (sharp.height - H) // 2,
                        (sharp.width - W) // 2 + W, (sharp.height - H) // 2 + H))
    px = 0
else:
    ph = int(H * 1.25)                      # slight overscale, cropped evenly
    pw = round(photo.width * ph / photo.height)
    sharp = photo.resize((pw, ph), Image.LANCZOS)
    top = (ph - H) // 2
    sharp = sharp.crop((0, top, pw, top + H))
    px = W - sharp.width                    # bleeds off the right edge

# --- Organic dissolve mask ------------------------------------------------
mask = Image.new('L', (W, H), 0)
draw = ImageDraw.Draw(mask)
edge_x = W * EDGE
amp = W * FEATHER * 0.62

for y in range(H):
    t = y / H
    wobble = (math.sin(t * 5.6 + 0.7) * 0.55
              + math.sin(t * 2.1 + 2.4) * 0.32
              + math.sin(t * 11.3 + 1.1) * 0.13)
    draw.line([(edge_x + wobble * amp, y), (W, y)], fill=255)

mask = mask.filter(ImageFilter.GaussianBlur(radius=W * FEATHER * 0.16))

layer = Image.new('RGB', (W, H), SAND)
layer.paste(sharp, (px, 0))
canvas = Image.composite(layer, wash, mask)

# --- Sand veil over the copy area ----------------------------------------
# Takes the wash up to something close to flat sand where the words go, then
# falls away — with its own wobble, so the veil never draws a line of its own.
# 247/255 is set by contrast rather than taste: it's what puts ink-soft body
# text at 4.5:1 against the band, which bare wood grain misses badly.
veil_mask = Image.new('L', (W, H), 0)
vd = ImageDraw.Draw(veil_mask)
for y in range(H):
    t = y / H
    wobble = math.sin(t * 4.2 + 1.9) * 0.6 + math.sin(t * 9.1 + 0.4) * 0.25
    vd.line([(0, y), (edge_x + wobble * amp * 0.8, y)], fill=247)
veil_mask = veil_mask.filter(ImageFilter.GaussianBlur(radius=W * FEATHER * 0.26))

canvas = Image.composite(Image.new('RGB', (W, H), SAND), canvas, veil_mask)
canvas.save(OUT, quality=84, optimize=True, progressive=True)
print(OUT, canvas.size)
