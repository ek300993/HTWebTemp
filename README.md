# Happy Turtle — WordPress site

## Live preview (share this with the client)

**https://playground.wordpress.net/?blueprint-url=https://raw.githubusercontent.com/ek300993/HTWebTemp/main/demo/blueprint.json**

Runs the whole site — WordPress, PHP, database — inside the visitor's browser via
WebAssembly. No hosting, no login, nothing to install. Takes ~30–60s to boot the
first time while it downloads WordPress and the theme.

It's a *working* site, not a screenshot: the client can browse it, and can click
**Edit Page** or **Edit Site** in the top bar to open the real block editor and
try changing text or adding a basket. That's the part worth showing — the design
is only half the pitch, the other half is how safe it is to edit.

Two things to tell them:

- Every visitor gets their own fresh copy, and changes vanish on reload. Nothing
  they do can break it, and nothing they type is saved.
- The order form is a placeholder. It needs a form plugin, which is a hosting-time
  decision (see "Deliberate omissions").

### Regenerating the preview

The blueprint installs from zips committed in `demo/`, so rebuild them after any
theme or plugin change:

```bash
cd wp-content/themes  && zip -qr ../../demo/happy-turtle.zip happy-turtle -x "*.DS_Store"
cd ../plugins         && zip -qr ../../demo/happy-turtle-gifts.zip happy-turtle-gifts -x "*.DS_Store"
```

Then commit and push. GitHub's raw CDN caches branch URLs for ~5 minutes, so give
it a moment before re-testing or you'll be looking at the previous build.

`demo/seed.php` creates the sample baskets and sideloads their photos out of the
theme; `demo/blueprint.json` embeds a copy of it. Regenerate the blueprint if you
change the seed — don't hand-edit the JSON, the PHP is escaped inside it.


A custom block theme plus a small catalogue plugin for a gift-basket studio.
Built on core WordPress blocks only: no page builder, no parent theme, no
proprietary block library.

```
wp-content/
├── themes/happy-turtle/          the design
│   ├── theme.json                colours, type, spacing, layout — the source of truth
│   ├── style.css                 the few things theme.json can't express
│   ├── functions.php             assets, pattern category, one helper
│   ├── inc/
│   │   ├── block-styles.php      Heart Divider, Handwritten, Eyebrow, Plain list
│   │   └── setup-content.php     one-time page creation on first activation
│   ├── templates/                page/post/archive templates
│   ├── parts/                    header, footer
│   ├── patterns/                 every page section, as an editable pattern
│   └── assets/images/            logo.png + placeholder.svg
└── plugins/happy-turtle-gifts/   the Baskets post type + Occasions taxonomy
```

## Installing

1. Copy `wp-content/themes/happy-turtle` and
   `wp-content/plugins/happy-turtle-gifts` into the site's `wp-content`.
2. **Activate the plugin first** (Plugins → Happy Turtle Gift Baskets). It
   registers the Baskets post type and seeds the five occasions.
3. Activate the theme (Appearance → Themes → Happy Turtle).
4. Settings → Permalinks → Save once, to flush rewrite rules so `/shop/`,
   `/baskets/…` and `/occasion/…` resolve.
5. Upload the logo (Appearance → Editor → click the header logo).
   `assets/images/logo.png` ships with the theme.

Activating the theme runs a one-time setup that creates Home, About, How It
Works, Reviews and Contact, fills the homepage with the section patterns, and
sets it as the front page. Guarded by the `happy_turtle_setup_complete` option,
so it never runs twice and never overwrites edited content. Delete that option
to re-run it on a scratch install.

Requires WordPress 6.6+ (the grid layout type) and PHP 7.4+. Verified against
**WordPress 7.0.3 / PHP 8.3.33**.

## The content model

**Baskets** are a custom post type registered in the *plugin*, not the theme, so
they survive a future re-theme. Each basket has a photo, an excerpt (the one-line
teaser in grids), occasions, and a body. New baskets open with a pre-built
skeleton — description, **What's Inside** list, **Sizes & Pricing** list —
because those are the two things every basket needs and the two things easiest
to forget.

| | |
|---|---|
| Post type | `basket` — "Gift Baskets", menu label "Baskets" |
| Archive | `/shop/` |
| Single | `/baskets/<slug>/` |
| Taxonomy | `basket_occasion` — "Occasions", at `/occasion/<slug>/` |
| Seeded occasions | For Teachers, Weddings, New Home, New Baby, Graduation, Thank You |

Graduation was added after looking at the supplied photography — two of the five
sample shots are graduation baskets, so it is clearly a real line, and it wasn't
in the original design's five tiles.

**Baskets are a portfolio, not a product list.** Every order is custom, so the
catalogue reads as examples of past work rather than things you can add to a
cart. That framing is deliberate and shows up in several places — change them
together or the site starts making promises it can't keep:

- Shop archive carries a "these are examples, yours will be built around you" line
- Single basket CTA is "Request a Basket Like This", not "Order"
- The note under it says plainly that it's an example, not a fixed product
- Related row is "More baskets I've made"
- Editor headings are "What Went Inside" and "Size & Price Guide", with prices
  worded "from £X"

No custom price meta field. Pricing lives in the basket body — since there's no
checkout and every basket is quoted individually, structured price data buys
nothing and would cost a custom block to display.

## How the design is wired

**`theme.json` is the design system.** Eight colours, three font families, eight
font sizes, six spacing steps. Nothing hard-codes a hex value.

It also deliberately closes doors: `color.custom: false` and
`typography.customFontSize: false` remove the free-form colour picker and font
size input from the editor entirely. Verified in the running editor —
`disableCustomColors`, `disableCustomFontSizes` and `disableCustomGradients` all
report `true`, and the palette offers exactly the eight brand colours. That's
what keeps the site on-brand a year from now. Both are one-line changes if it
proves too tight.

**Patterns are the page sections.** Each file in `patterns/` is one section.
They appear in the inserter under "Happy Turtle", and inserting one copies its
blocks into the page — fully editable, not a locked reference.
`inc/setup-content.php` builds the starter pages by reading those same files, so
each section has one source of truth.

**Locking is selective, not blanket:**

| Locked (`templateLock: contentOnly`) | Unlocked |
|---|---|
| Hero, About split, CTA banner | Occasion grid, Featured baskets, Value props, How it works, Reviews |

Locked sections expose only text and images — confirmed in the editor, where the
hero's sidebar lists exactly Heading / Paragraph / Buttons / Image and no
structural blocks. The unlocked ones are the sections the owner will legitimately
want to extend. Remove the `"templateLock":"contentOnly"` attribute from a
pattern's outer group to unlock it.

**Featured Baskets is a Query Loop**, not a hand-built grid. Publishing a basket
puts it on the homepage with no page editing at all. Highest-value piece of the
build for a non-technical owner.

## Deliberate omissions

**The order form.** `patterns/page-contact.php` has a marked slot and nothing
else. Spam filtering, file uploads and reliable delivery are the whole job of a
form plugin. Install one (Fluent Forms and WPForms are both good) and drop its
block in the slot. Check that **file upload is in the tier you pick** — customers
sending reference photos matters here, and it's a paid feature in some plugins.

## Photography

Source files live in `/Assets`; web-optimised versions (max 1600px, q82) are in
`/Assets/web` and shipped in `themes/happy-turtle/assets/images/` so a fresh
install looks right immediately rather than showing a grid of empty boxes.

| File | Used for |
|---|---|
| `new-home-welcome.jpg` | Hero, New Home tile, Housewarming Basket |
| `new-baby-elephant.jpg` | About section, New Baby tile |
| `new-baby-letterboard.jpg` | Welcome Baby Basket |
| `graduation-crate.jpg` | Graduation tile, Graduation Crate |
| `graduation-class-2026.jpg` | Class of 2026 Basket |

`graduation-class-2026.jpg` had an "It's 🎓 season!!" Instagram text overlay baked
into the original; the top 15% is cropped off in the web version. Use
`/Assets/web` rather than the raw files.

For Teachers, Weddings and Thank You have no photograph yet and fall back to
`placeholder.svg` — a warm neutral deliberately distinct from cream/sand/sage so
the slot stays visible on every section background. Every tile image is pinned
to a 4:3 `aspect-ratio` with `object-fit: cover`, so real photos and placeholders
sit in an even row regardless of what gets uploaded.

**Worth confirming before launch:** these photos show real customers' names
(Abigail, Chloe, Clem + Connie, the Ort family, Syndey, Oshlee). They appear to
be the studio's own social posts, but a website is more permanent and more
indexable than an Instagram post — worth a quick check that everyone's happy to
appear there.

## Gotchas worth knowing

**Fonts are approximations.** Cormorant Garamond, Jost and Parisienne were
matched by eye from the design mockup. Swap in `theme.json` →
`settings.typography.fontFamilies` plus the Google Fonts URL in `functions.php`.

**Fonts load from Google.** Fine for most sites; self-host (woff2 in
`assets/fonts/` + `fontFace` entries) if you want to avoid the GDPR argument.

**Grid rows use `auto-fill`, not `auto-fit`.** WordPress preserves empty tracks,
so a `minimumColumnWidth` that's too small leaves a gap at the end of a row. The
values in the patterns are tuned so each row lands exactly at `wideSize` (1240px)
— 5 occasion tiles in 5 columns, 4 baskets in 4. If you change the item count in
a row, retune that width.

**`main` uses flow layout, not constrained.** This is load-bearing, and it bit
twice. Any constrained container wrapping `wp:post-content` caps post-content at
`contentSize`, and every full-width section inside silently collapses to 760px.
That applies to `main` *and* to the padded content wrapper in `page.html` and
`single.html` — all three are flow. Don't "fix" them back.

The tell: a page looks narrower than the homepage. Check
`getComputedStyle` on `.wp-block-post-content` — if `max-width` is 760px on a
pattern-built page, a parent is constrained.

Because those wrappers are flow, `style.css` uses `:has()` to drop their padding
and blockGap when the content starts or ends with a full-bleed section — without
it the wrapper padding shows as a stripe of page background above the first band.

**Renaming a pattern file needs a cache clear.** WordPress caches the theme's
pattern file list in a transient; renames log "could not register file" notices
until you flush it.

**The palette is low-contrast by design, so band adjacency matters.** Interior
pages put a sand title banner straight onto the first content section, and the
sections don't know what precedes them. Reviews ends up sand-on-sand — literally
the same colour on both sides — and About is sand-on-sage, one shade apart. The
`.ht-page-header` hairline exists to give that seam somewhere to land; without it
the Reviews banner and the first section read as one continuous block. If you
add a pattern that might sit directly under a title banner, either give it a
background that steps away from sand or leave the hairline alone.

## Verification status

Ran against a real WordPress 7.0.3 install (SQLite, PHP 8.3.33). Confirmed:

- All routes 200, unknown URLs 404, error log clean — no warnings, notices or fatals
- All 13 PHP files lint clean
- All 9 patterns parse and round-trip through `parse_blocks`/`serialize_blocks`
- **86 blocks on the homepage, 0 invalid, 0 missing** in the actual block editor
- Palette and font-size restrictions active; content-only locking active on the three intended sections
- Responsive from 375px to 1440px with no horizontal overflow

Bugs found and fixed during that pass, all of which static checking had missed:
constrained-`main` collapsing full-width sections to 760px; empty `<img>` tags
being stripped entirely so hero/about columns rendered at 0 height; grid rows
leaving empty trailing tracks; adjacent full-bleed sections separated by a
blockGap stripe; and baskets recommending themselves under "You might also like".

`scratchpad/validate.py` statically checks attribute JSON, delimiter balance and
preset references if you edit markup by hand rather than through the editor.
