# Happy Turtle — WordPress site

## Two preview links

### 1. Static preview — reliable, send this one

**https://ek300993.github.io/HTWebTemp/**

A plain-HTML crawl of the finished site on GitHub Pages. Loads instantly in any
browser, nothing to boot, nothing that can fail. Every page, every image, all
the navigation.

What it can't do, because it's static files: the block editor, the search box,
and the inquiry form — the form is on the Contact page and looks right, but a
static file has nothing to post to. It's for looking at, not for trying.

Rebuild it after content or design changes with `scripts/mirror.py` (crawls
`localhost:8080` into `docs/`), then commit and push — Pages redeploys itself.

### 2. Playground preview — shows the editing experience

**https://playground.wordpress.net/?blueprint-url=https://raw.githubusercontent.com/ek300993/HTWebTemp/main/demo/blueprint.json**

Runs the whole site — WordPress, PHP, database — inside the visitor's browser via
WebAssembly, so the client can open the real block editor and try changing
something. Takes ~30–60s to boot.

**It doesn't always load.** Playground relies on a service worker and
WebAssembly, and it fails for reasons that have nothing to do with this site:
a stale service worker after one of their deploys, privacy extensions, corporate
networks, older browsers. Observed failures include the app shell never fetching
its own JS bundle, and hanging on "Preparing WordPress". A hard reload or a
different browser usually clears it.

Use the static link as the default and this one when you specifically want to
show off how editable the site is.

It's a *working* site, not a screenshot: the client can browse it, and can click
**Edit Page** or **Edit Site** in the top bar to open the real block editor and
try changing text or adding a basket. That's the part worth showing — the design
is only half the pitch, the other half is how safe it is to edit.

Two things to tell them:

- Every visitor gets their own fresh copy, and changes vanish on reload. Nothing
  they do can break it, and nothing they type is saved.
- The inquiry form works, but Playground has no mail server, so a submission
  reports success and goes nowhere.

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
    └── inc/contact-form.php      the inquiry form on the Contact page
```

## Installing

1. Copy `wp-content/themes/happy-turtle` and
   `wp-content/plugins/happy-turtle-gifts` into the site's `wp-content`.
2. **Activate the plugin first** (Plugins → Happy Turtle Gift Baskets). It
   registers the Baskets post type, seeds the eight occasions, and adds the
   inquiry form shortcode the Contact page depends on.
3. Activate the theme (Appearance → Themes → Happy Turtle).
4. Settings → Permalinks → Save once, to flush rewrite rules so `/shop/`,
   `/baskets/…` and `/occasion/…` resolve.
5. Upload the logo (Appearance → Editor → click the header logo).
   `assets/images/logo.png` ships with the theme.
6. Settings → General → **Gift basket inquiries** — the address the Contact form
   delivers to. Left empty it falls back to the site admin address.

Activating the theme runs a one-time setup that creates the seven pages — Home,
About, Browse Baskets, How It Works, Gallery, Reviews, Contact — fills each with
its section patterns, and sets Home as the front page. Guarded by the
`happy_turtle_setup_complete` option, so it never runs twice and never overwrites
edited content. Delete that option to re-run it on a scratch install.

**The menu is the page list.** The header's Navigation block has no saved menu of
its own, so it falls back to a Page List: every published page, in `menu_order`.
That order is set by the array in `inc/setup-content.php` on first run, and after
that it's Pages → Quick Edit → Order. Adding a page adds it to the menu; there is
no separate menu to keep in sync, which is the point.

Requires WordPress 6.6+ (the grid layout type) and PHP 7.4+. Verified against
**WordPress 7.0.4 / PHP 8.3.33**.

## The content model

**Baskets** are a custom post type registered in the *plugin*, not the theme, so
they survive a future re-theme. Each basket has a photo, an excerpt (the one-line
teaser in grids), occasions, and a body. New baskets open with a pre-built
skeleton — description and a **What Went Inside** list — because that's what
every basket page needs and what's easiest to forget.

| | |
|---|---|
| Post type | `basket` — "Gift Baskets", menu label "Baskets" |
| Archive | `/shop/` |
| Single | `/baskets/<slug>/` |
| Taxonomy | `basket_occasion` — "Occasions", at `/occasion/<slug>/` |
| Seeded occasions | New Baby, New Home, Graduation, Weddings, Retirement, Birthday, For Teachers, Thinking of You |

Those eight are the studio's own list. Two arrived late — Birthday and Retirement
— and "Thank You" became "Thinking of You", which the plugin's activation routine
renames in place rather than adding alongside, so any basket already filed under
it keeps its occasion.

**Three places have to agree on the eight:** the taxonomy list in the plugin, the
heading anchors in `patterns/page-browse-baskets.php`, and the tile links in
`patterns/occasion-grid.php`. The Browse Baskets page is the one people see, so
start there and work outwards.

**Browse Baskets is a page, `/shop/` is the archive.** They do different jobs.
Browse Baskets describes each kind of basket and what tends to go in one — it is
written copy, always populated, and it's what the nav, the hero button and the
occasion tiles point at. `/shop/` lists the baskets actually published, so it is
only as full as the catalogue. It stays live and linked from search results and
from an empty occasion archive, but nothing on the homepage sends people there
any more. If the catalogue ever grows past a dozen baskets, promoting it back
into the menu is a one-line change to `setup-content.php`.

The occasion tiles on the homepage link to `/browse-baskets/#new-baby` and
friends rather than to `/occasion/new-baby/`, because five of the eight occasions
have no baskets published against them yet and an empty archive is a dead end.

**Browse Baskets is eight full-bleed bands**, alternating cream/sand and photo
left/right, each one a lead sentence, four "often includes" items set two-up, and
its own link into the contact form. Three pieces of furniture carry the length:
a row of jump-link pills under the intro, the alternating bands themselves, and a
back-to-top chevron pinned bottom-right. The chevron fades in on scroll with a
scroll-driven CSS animation — no JavaScript, and where scroll timelines aren't
supported yet it simply stays visible throughout. All of it lives in the page's
own content rather than the footer template, so it appears on that page only.

**Baskets are a portfolio, not a product list.** Every order is custom, so the
catalogue reads as examples of past work rather than things you can add to a
cart. That framing is deliberate and shows up in several places — change them
together or the site starts making promises it can't keep:

- Shop archive carries a "these are examples, yours will be built around you" line
- Single basket CTA is "Request a Basket Like This", not "Order"
- The note under it says plainly that it's an example, not a fixed product
- Related row is "More baskets I've made"
- The only editor heading is "What Went Inside"

**No prices anywhere on the site.** No price meta field, no price list in the
basket skeleton — since there's no checkout and every basket is quoted
individually, pricing is handled in the reply to an inquiry. If prices are ever
wanted back, they go in the basket body as an ordinary list; nothing in the
theme or plugin needs to change.

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
| Hero, About intro, About personal, About split, CTA banner | Occasion grid, Browse Baskets, Featured baskets, Gallery sections, Value props, How it works, Reviews, Contact |

Locked sections expose only text and images — confirmed in the editor, where the
hero's sidebar lists exactly Heading / Paragraph / Buttons / Image and no
structural blocks. The unlocked ones are the sections the owner will legitimately
want to extend: another occasion tile, another kind of basket, more photographs.
Remove the `"templateLock":"contentOnly"` attribute from a pattern's outer group
to unlock it.

**Featured Baskets is a Query Loop**, not a hand-built grid. Publishing a basket
puts it on the Gallery page with no page editing at all. Highest-value piece of
the build for a non-technical owner. It sat on the homepage until the Gallery
page existed; the homepage now sends people to Browse Baskets to pick an occasion
instead.

**The two gallery sections are core Gallery blocks.** Adding a photograph is
select-the-gallery, press +, upload — no column count to retune and no half-empty
row, because the block reflows itself. They ship with eight and six slots and are
meant to grow to fifteen or twenty each.

## The inquiry form

Four fields — email, phone, what they're after, and a message — on the Contact
page, rendered by `[happy_turtle_contact_form]` from
`plugins/happy-turtle-gifts/inc/contact-form.php`. It posts to `admin-post.php`
and emails the result on, with the sender's address as `Reply-To` so a reply goes
straight back to them.

The "what are you after" menu is built from the Occasions taxonomy at render
time, plus *An individual item*, *Bulk or corporate gifting* and *Something
else* — so adding an occasion adds it to the form with no further work.

Against spam: a nonce, a honeypot field only a bot fills in, and three
submissions per email address per fifteen minutes. No captcha — that charges
every real visitor for a problem this site doesn't have yet.

**Two things to do at launch:**

- Set the delivery address at Settings → General → *Gift basket inquiries*.
- **Install an SMTP plugin.** Delivery is `wp_mail()`, which falls through to PHP
  `mail()` unless something else is configured, and on a lot of shared hosting
  that means spam folders or silent loss. WP Mail SMTP or Post SMTP, pointed at
  the studio's own mailbox, takes ten minutes and is the difference between
  inquiries arriving and not.

**The upgrade path is still a form plugin** the day any of these matters: file
uploads (customers sending reference photographs is the obvious one), conditional
fields, or a stored record of every inquiry rather than just an email. Delete the
shortcode block on the Contact page and drop the plugin's form block in its
place; nothing else on the site depends on it. Check that **file upload is in the
tier you pick** — it's a paid feature in some.

## Photography

Source files live in `/Assets`; web-optimised versions (max 1600px, q82) are in
`/Assets/web` and shipped in `themes/happy-turtle/assets/images/` so a fresh
install looks right immediately rather than showing a grid of empty boxes.

| File | Used for |
|---|---|
| `hero-banner.jpg` | Hero, 1100px and up (built — see below) |
| `hero-scene.jpg` | Hero, below 1100px (the same scene, unblended) |
| `brand-card.jpg` | About section |
| `new-home-welcome.jpg` | New Home tile + row, Housewarming Basket, gallery |
| `new-baby-elephant.jpg` | New Baby tile + row, gallery |
| `new-baby-letterboard.jpg` | Welcome Baby Basket, gallery |
| `graduation-crate.jpg` | Graduation tile + row, Graduation Crate, gallery |
| `graduation-class-2026.jpg` | Class of 2026 Basket, gallery |

`graduation-class-2026.jpg` had an "It's 🎓 season!!" Instagram text overlay baked
into the original; the top 15% is cropped off in the web version. Use
`/Assets/web` rather than the raw files.

`new-baby-myles.jpg` came in as a PNG (`new-baby-myles.png`) at 1086×1448 — under
the 1600px ceiling, so the web version is the same size rather than an upscale,
and it's encoded at q68 instead of q82 because the studio background is a large
flat wash that JPEG spends a lot of bytes on at higher quality.

### The hero banner

`hero-banner.jpg` is built by `scripts/make-hero-banner.py` from
`Assets/hero-banner.png` — a wide version of the Myles photograph with the scene
painted out to the left, supplied rather than shot.

The script's job is the left-hand end of that band. It takes the same image,
stretches and blurs it past recognition into a wash, dissolves the sharp picture
into that wash along an organic edge, and veils the result towards sand so the
headline has a calm field to sit on. Because the wash is made from the picture,
the two sides always agree on colour — the band stays sage at the top and warm at
the bottom without anyone choosing a panel colour that's wrong somewhere. The
dissolve edge is three sine waves of different frequencies summed and then
blurred, so it wanders instead of ruling a line.

```bash
python3 scripts/make-hero-banner.py Assets/hero-banner.png \
  wp-content/themes/happy-turtle/assets/images/hero-banner.jpg 2800 1270 0.50 0.24 extend
```

The numbers are width, height, where the sharp picture starts as a fraction of
the width, how far the dissolve reaches back from it, and the mode. `extend` is
for a source that's already a wide banner; `wide` takes an ordinary portrait
photo and places it at the right, building the whole left-hand side from the
wash.

The veil strength inside the script (247/255) is set by contrast, not taste:
ink-soft body text over the bare wood grain of the original measures 2.6:1, well
under AA. Over the veiled band it measures 4.5:1. Lighten the veil and the
supporting line under the headline stops being readable — check it if you change
that number.

Above 1100px the band's height is `clamp(500px, 45vw, 860px)` rather than a fixed
number, so the box stays at roughly the banner's own 2.2:1 and the basket never
gets letterboxed off the bottom on a wide monitor.

**Below 1100px the hero uses a different file.** There's no room for words beside
the basket at those widths, so the copy goes over the picture — and the blended
banner is the wrong image for that, because a phone-width crop of it is mostly
wash. `hero-scene.jpg` is the same wide scene with no blend applied (plain
`sips`-style resize of `Assets/hero-banner.png` to 2800px, q82), shown as a CSS
`background-image` on the cover — CSS can't swap an `<img>` src, so the block's
own image is hidden there. The cover's dim layer, unused at these widths, becomes
the scrim that keeps the text readable.

That scrim is an even 78% sand veil — flat, not a gradient — and it's sized
against the **worst patch** behind the words rather than the average, which is
the part that actually decides whether a page reads. The elephant's ears and the
milestone plaque sit directly under the headline and are much darker than the
wall around them: at a 58% veil the average looks comfortable but the green over
those ears falls to **2.8:1**, under the 3:1 large-text minimum. At 78%, with
the supporting line switched from ink-soft to full ink, body text holds
**8.6:1** against its darkest patch and the headline green **4:1**. Over the
bare photograph, for reference, ink-soft measures 1.5:1.

Below 782px the crop also shifts to `89%` so the basket is centred under the
copy; between 782 and 1100px it stays at `82%`, which keeps the basket to the
right of the words the way the desktop band does.

Changing the hero photograph means getting the scene extended sideways first —
the script blends an existing wide picture rather than inventing one — then
re-running the command above for `hero-banner.jpg` and dropping a plain 2800px
resize of the same source in as `hero-scene.jpg`. That's the one place on the
site where changing a picture isn't just a click.

`new-baby-myles.jpg` (in `/Assets/web`, not shipped in the theme) is the original
portrait shot the banner was painted out from. Nothing on the site uses it now;
it's kept because it's the source of record for the hero.

**Everything else on the site is a placeholder slot**, and there are a lot of
them now that the site has eight occasions, an About page and a gallery:

| Slot | Where | Count |
|---|---|---|
| Teachers, Weddings, Birthday, Retirement | occasion tiles + Browse Baskets rows | 4 each, shared |
| Thinking of You | Browse Baskets row | 1 |
| A headshot | About → Nice to Meet You | 1, portrait 4:5 |
| Joyce away from the studio | About → Personal Life | 1, portrait 4:5 |
| More baskets | Gallery → The Baskets | 3 empty of 8 |
| Individual items | Gallery → Individual Items | 6, all empty |

They all fall back to `placeholder.svg` — a warm neutral deliberately distinct
from cream/sand/sage so the slot stays visible on every section background. Tile
and gallery images are pinned to a fixed `aspect-ratio` with `object-fit: cover`
(4:3 for tiles and Browse Baskets rows, 1:1 in the galleries), so real photos and
placeholders sit in an even row regardless of what gets uploaded. The two About
portraits are 4:5, and the hero's stacked phone photo is 4:5 too, because that
picture is portrait and a landscape crop cut the top off the basket.

A real file rather than an empty image block, always: WordPress strips an `<img>`
with no `src`, which collapses the column to nothing.

The About section's image is on no ratio at all — it runs at the column's full
width and its own natural height, uncropped. `brand-card.jpg` is a logo shot, so
any crop takes an end off the wordmark; showing all of it matters more there than
filling the band edge to edge. The band is still deliberately shallow — `lg`
padding on the text column rather than `xxl` — so the picture comes close to
filling it anyway, with a little sage above and below.

**Worth confirming before launch:** these photos show real customers' names
(Abigail, Chloe, Clem + Connie, the Ort family, Syndey, Oshlee, Myles). They
appear to be the studio's own social posts, but a website is more permanent and
more indexable than an Instagram post — worth a quick check that everyone's happy
to appear there.

The hero photo needs that check most. The milestone plaque in it is legible at
full size: an infant's full name, date of birth, weight, length and time of
birth, on the largest image on the front page. Everything else on the site shows
a first name at most.

## Gotchas worth knowing

**Fonts are approximations.** Cormorant Garamond, Jost and Parisienne were
matched by eye from the design mockup. Swap in `theme.json` →
`settings.typography.fontFamilies` plus the Google Fonts URL in `functions.php`.

**Fonts load from Google.** Fine for most sites; self-host (woff2 in
`assets/fonts/` + `fontFace` entries) if you want to avoid the GDPR argument.

**Grid rows use `auto-fill`, not `auto-fit`.** WordPress preserves empty tracks,
so a `minimumColumnWidth` that's too small leaves a gap at the end of a row. The
values in the patterns are tuned so each row lands exactly at `wideSize` (1240px)
— 7 occasion tiles at `9.5rem`, 4 process steps at `17rem`, 4 baskets at `16rem`.
If you change the item count in a row, retune that width: the sum is
`(items × width) + (gaps × blockGap) ≤ 1240px`, and one more column must not fit.

The occasion row is the tight one. Seven tiles come out 157px wide on a desktop,
which is small but legible; an eighth would need about 137px and start to look
like a contact sheet. It's also why that row carries an explicit two-column rule
below 600px — the column minimum small enough for seven across is small enough
for a phone to fit exactly one, and seven full-width tiles is two and a half
screens of scrolling.

**The cover block's inner container moved under the theme in WordPress 7.0.4.**
The rule that positions it went from two classes to five — core doubles
`.has-custom-content-position` to buy specificity — and picked up `width: auto`
along the way. Both halves broke the hero: shrink-to-fit plus a percentage-width
child collapsed the copy into a narrow gutter, and the raised weight beat the
theme's `margin-inline: auto`, so on a wide monitor the headline stopped lining
up with the column every other section uses. `style.css` matches core's weight
with the same doubled class and restores width, max-width and centring together.

If the hero copy ever looks wrong after a WordPress update, that rule is the
first place to look. The tell is `getComputedStyle` on
`.wp-block-cover__inner-container`: it should report the wide size plus gutters,
and an auto margin.

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

Ran against a real WordPress 7.0.4 install (SQLite, PHP 8.3.33). Confirmed:

- All routes 200 (seven pages, the shop archive, occasion archives, basket
  singles), unknown URLs 404, **error log completely empty** across a full sweep
- All 20 PHP files lint clean
- All 15 patterns register, parse, and round-trip through
  `parse_blocks`/`serialize_blocks` with no drift on any of the seven pages
- Menu renders in the intended order — Home · About · Browse Baskets · How It
  Works · Gallery · Reviews · Contact — from page order alone
- Inquiry form exercised end to end: valid submission delivers with the right
  Reply-To; honeypot silently drops; bad nonce, bad email and bad request type
  all rejected; off-site return URL falls back to the homepage; rate limit trips
  on the fourth message
- Responsive from 360px to 2560px with **no horizontal overflow on any page**,
  and the occasion row stepping 2 → 3 → 4 → 5 → 7 columns as it widens

Bugs found and fixed during this pass, none of which static checking would have
caught: the WordPress 7.0.4 cover-block change collapsing the hero copy into a
narrow gutter and un-centring it on wide monitors; the seven-item menu no longer
fitting beside the logo and needing the overlay breakpoint moved; and the
occasion row's tuned column minimum leaving a phone with exactly one tile per
row, seven rows deep.

Earlier passes fixed, and these still hold: constrained-`main` collapsing
full-width sections to 760px; empty `<img>` tags being stripped entirely so
columns rendered at 0 height; grid rows leaving empty trailing tracks; adjacent
full-bleed sections separated by a blockGap stripe; and baskets recommending
themselves under "You might also like".

`scratchpad/validate.py` statically checks attribute JSON, delimiter balance and
preset references if you edit markup by hand rather than through the editor.
