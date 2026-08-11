const fs = require("fs");
const {
  Document, Packer, Paragraph, TextRun, HeadingLevel, AlignmentType,
  PageOrientation, BorderStyle,
} = require("docx");

/* ---------- small builders ---------- */

const H1 = (t) => new Paragraph({
  text: t, heading: HeadingLevel.HEADING_1,
  spacing: { before: 360, after: 160 },
});

const H2 = (t) => new Paragraph({
  text: t, heading: HeadingLevel.HEADING_2,
  spacing: { before: 260, after: 100 },
});

// "Where it sits" label above a piece of copy
const label = (t) => new Paragraph({
  spacing: { before: 140, after: 20 },
  children: [new TextRun({ text: t, bold: true, size: 19, color: "444444" })],
});

const body = (t) => new Paragraph({
  spacing: { after: 60 }, children: [new TextRun({ text: t, size: 22 })],
});

// invented content the client has to replace
const flag = (t) => new Paragraph({
  spacing: { after: 100 },
  children: [new TextRun({ text: t, italics: true, size: 19, color: "8A3324" })],
});

const note = (t) => new Paragraph({
  spacing: { after: 100 },
  children: [new TextRun({ text: t, italics: true, size: 19, color: "555555" })],
});

const bullet = (t) => new Paragraph({
  bullet: { level: 0 }, spacing: { after: 40 },
  children: [new TextRun({ text: t, size: 22 })],
});

const rule = () => new Paragraph({
  spacing: { before: 200, after: 0 },
  border: { bottom: { style: BorderStyle.SINGLE, size: 6, color: "CCCCCC", space: 1 } },
  children: [new TextRun({ text: "" })],
});

// a labelled block: where it sits + the words
const item = (where, ...lines) => [label(where), ...lines.map(body)];

/* ---------- document ---------- */

const kids = [];

kids.push(new Paragraph({
  spacing: { after: 60 },
  children: [new TextRun({ text: "Happy Turtle Custom Gifts", bold: true, size: 36 })],
}));
kids.push(new Paragraph({
  spacing: { after: 240 },
  children: [new TextRun({ text: "Website copy, page by page", size: 26, color: "555555" })],
}));

kids.push(body("Every word currently on the site, in the order it appears. Edit anything directly in this document and send it back."));
kids.push(new Paragraph({ spacing: { after: 120 }, children: [] }));
kids.push(new Paragraph({
  spacing: { after: 60 },
  children: [new TextRun({ text: "One thing to read first", bold: true, size: 22 })],
}));
kids.push(body("Some of what's on the site now is content I invented so the pages weren't empty. It reads as real, so it can't stay. Anything invented is marked in red italics below."));
kids.push(body("The most important is the reviews — all three are made up. Publishing invented testimonials carries FTC penalties in the US, so those need replacing with real customer words before the site goes public, even if that means starting with just one."));
kids.push(body("Also invented: all prices, all basket contents, the turnaround times, and the basket names."));

kids.push(rule());

/* ---------- site-wide ---------- */
kids.push(H1("Appears on every page"));

kids.push(H2("Header"));
kids.push(...item("Menu", "Home · About · How It Works · Reviews · Contact"));
kids.push(...item("Button (top right)", "Start an Order"));

kids.push(H2("Footer"));
kids.push(...item("Tagline under the logo", "Beautifully curated gift baskets for life's special moments."));
kids.push(...item("Column heading", "Explore"));
kids.push(...item("Links", "Shop All Baskets", "How It Works", "Reviews", "About"));
kids.push(...item("Column heading", "Get in Touch"));
kids.push(...item("Text", "Have an idea for something special?", "I'd love to hear about it."));
kids.push(...item("Link", "Start an order →"));
kids.push(...item("Above the Instagram icon", "See what's in the studio this week:"));
kids.push(...item("Bottom line", "© Happy Turtle Custom Gifts · Handmade with love"));

kids.push(rule());

/* ---------- home ---------- */
kids.push(H1("Home"));

kids.push(H2("Opening section"));
kids.push(...item("Headline", "Thoughtful Gifts,", "Made Just for You"));
kids.push(note("The second line is in green italics."));
kids.push(...item("Below the headline", "Beautifully curated gift baskets for life's special moments. Hand-packed, just for you."));
kids.push(...item("Button", "Shop Gift Baskets"));

kids.push(H2("The four promises"));
kids.push(...item("1", "Curated with Love", "Every basket is chosen and packed by hand."));
kids.push(...item("2", "Truly Unique", "Built around the person you are gifting."));
kids.push(...item("3", "Quality You Can Trust", "Small-batch makers and quality ingredients."));
kids.push(...item("4", "Ready to Gift", "Wrapped, ribboned and delivered gift-ready."));

kids.push(H2("Occasions"));
kids.push(...item("Small label above the heading", "Handmade & Custom"));
kids.push(...item("Heading", "Baskets for Every Occasion"));
kids.push(label("The six tiles"));
["For Teachers", "Weddings", "New Home", "New Baby", "Graduation", "Thank You"].forEach((t) => kids.push(bullet(t)));
kids.push(note("For Teachers, Weddings and Thank You have no photograph yet — they show a grey placeholder box."));
kids.push(...item("Button", "Browse All Baskets"));

kids.push(H2("Recently made"));
kids.push(...item("Heading", "Recently Made"));
kids.push(...item("Below it", "A few baskets from the studio. Every one is built to order — use these as a starting point for yours."));
kids.push(note("The baskets in this row appear automatically. Nothing to write."));

kids.push(H2("Your introduction"));
kids.push(note("This section appears on both the Home page and the About page."));
kids.push(...item("Heading", "Hi, I'm so glad you're here!"));
kids.push(...item("Paragraph", "At Happy Turtle Custom Gifts, I believe the best gifts come from the heart. Every basket is put together by hand, piece by piece — so whether you're marking a milestone or just want to make someone smile, it arrives feeling personal rather than picked off a shelf."));
kids.push(...item("Handwritten line", "thank you for supporting my small business! ♥"));
kids.push(label("Three points on the right"));
["Small Business, Big Heart", "Eco-Conscious Packaging", "Happy Customers Are Everything"].forEach((t) => kids.push(bullet(t)));

kids.push(H2("Green banner"));
kids.push(note("This banner appears at the bottom of Home, About, How It Works and Reviews."));
kids.push(...item("Heading", "Ready to create something special?"));
kids.push(...item("Below it", "Let's bring your ideas to life."));
kids.push(...item("Button", "Get Started"));

kids.push(rule());

/* ---------- about ---------- */
kids.push(H1("About"));
kids.push(...item("Page title", "About"));
kids.push(note("The rest of this page is the introduction section and the green banner, both written out under Home above."));

kids.push(rule());

/* ---------- how it works ---------- */
kids.push(H1("How It Works"));
kids.push(...item("Page title", "How It Works"));
kids.push(...item("Small label", "Simple & Personal"));
kids.push(...item("Heading", "From idea to doorstep"));
kids.push(...item("Step 1", "Choose or describe it", "Pick one of my baskets, or tell me the occasion, the person and a rough budget."));
kids.push(...item("Step 2", "We agree the contents", "I'll send the line-up of everything going in, and swap anything for allergies or preferences."));
kids.push(...item("Step 3", "Hand-packed and sent", "Wrapped, ribboned and packed with your card message, ready to give."));
kids.push(flag("I guessed at your process. Please correct these three steps — do you send a photo proof? Take a deposit? Deliver locally, or post everything?"));

kids.push(rule());

/* ---------- reviews ---------- */
kids.push(H1("Reviews"));
kids.push(...item("Page title", "Reviews"));
kids.push(...item("Small label", "From Happy Customers"));
kids.push(...item("Heading", "Kind Words"));

kids.push(label("Review 1"));
kids.push(body("“The basket was beautiful. My daughter's teacher actually cried when she opened it.”"));
kids.push(body("— Sarah M."));
kids.push(label("Review 2"));
kids.push(body("“Ordered baskets for the whole bridal party. The contents list came back the same day.”"));
kids.push(body("— Priya R."));
kids.push(label("Review 3"));
kids.push(body("“Everything inside was lovely and the wrapping meant I could gift it as-is.”"));
kids.push(body("— Daniel K."));
kids.push(flag("All three reviews are invented — these people don't exist and never said this. Replace with real customer words before launch. For each you'll need: the quote, a first name and last initial, and optionally what the basket was for."));

kids.push(rule());

/* ---------- shop ---------- */
kids.push(H1("Shop — all baskets"));
kids.push(...item("Small label", "Handmade & Custom"));
kids.push(...item("Page title", "Gift Baskets"));
kids.push(...item("Intro paragraph", "Every basket is made to order. These are examples of baskets I've built — yours will be put together around your occasion, your budget and the person receiving it."));
kids.push(note("This line is what stops people reading the page as a fixed catalogue. Worth keeping something like it."));

kids.push(H2("Occasion pages"));
kids.push(note("One page per occasion, e.g. /occasion/graduation/. Same layout as above."));
kids.push(...item("Small label", "Baskets For"));
kids.push(...item("Page title", "The occasion name — Graduation, Weddings, and so on"));
kids.push(...item("Intro paragraph", "Same wording as the Shop page above."));

kids.push(rule());

/* ---------- basket page ---------- */
kids.push(H1("An individual basket page"));
kids.push(note("The wording below is fixed and appears on every basket page."));
kids.push(...item("Section heading", "What Went Inside"));
kids.push(...item("Section heading", "Size & Price Guide"));
kids.push(...item("Button", "Request a Basket Like This"));
kids.push(...item("Note under the button", "This is an example of a basket I've made, not a fixed product. Yours will be built around the occasion, any allergies or preferences, and your budget — tell me what you have in mind and I'll put a line-up together before anything is packed."));
kids.push(...item("Heading above the related baskets", "More baskets I've made"));

kids.push(H2("The five baskets currently on the site"));
kids.push(flag("Every name, description, contents list and price below is invented. I wrote them from looking at your photographs. Please replace with the real details, or tell me which baskets to show instead."));

const baskets = [
  ["Welcome Baby Basket", "For the whole new family",
    "A basket for the announcement moment — something for the baby, something for the parents, and a personalised letterboard for the photo everyone ends up taking.",
    ["Personalised letterboard with the arrival details", "Knitted blanket", "Plush giraffe and elephant", "Bodysuit and bib set", "Hooded towel"]],
  ["Personalised New Baby Basket", "Named, and made to keep",
    "Built inside a rope basket with the baby's name appliqued on the front, so the basket itself becomes the keepsake long after the contents are used up.",
    ["Rope storage basket with appliqued name", "Plush blanket", "Personalised bib and swaddle", "Wooden name hangers", "Treats for the parents"]],
  ["Housewarming Basket", "For a brand new front door",
    "Everything that makes a new place feel lived in on the first night, with a few things from around the neighbourhood so it feels like a proper welcome.",
    ["Fringed throw blanket", "Champagne and chocolate bark", "Local tote and neighbourhood guide", "Potted succulent", "Personalised letterboard"]],
  ["Graduation Crate", "Off to be amazing",
    "A wooden crate rather than a basket, so it stands up on a desk in a dorm room. Personalised tumbler, a few practical things, and a letterboard for the photos.",
    ["Personalised insulated tumbler", "Congrats Grad letterboard", "Handmade zip pouch", "Journal and pens", "Chocolate treats"]],
  ["Class of 2026 Basket", "The tassel was worth the hassle",
    "A softer take on the graduation basket — a Class of 2026 bear, a personalised rope basket, and a letterboard ready for the photo.",
    ["Class of 2026 embroidered bear", "Personalised rope basket", "Journal with keepsake ribbon", "Celebration letterboard", "Chocolate treats"]],
];

baskets.forEach(([name, excerpt, intro, items]) => {
  kids.push(new Paragraph({
    spacing: { before: 220, after: 60 },
    children: [new TextRun({ text: name, bold: true, size: 24 })],
  }));
  kids.push(...item("One-line summary (shown under the photo in grids)", excerpt));
  kids.push(...item("Description", intro));
  kids.push(label("What went inside"));
  items.forEach((i) => kids.push(bullet(i)));
  kids.push(label("Size & price guide"));
  ["Small — from $65", "Medium — from $95", "Large — from $130"].forEach((p) => kids.push(bullet(p)));
});

kids.push(rule());

/* ---------- contact ---------- */
kids.push(H1("Contact"));
kids.push(...item("Small label", "Let's Make Something"));
kids.push(...item("Page title", "Start an Order"));
kids.push(...item("Intro", "Tell me a little about the basket you have in mind and I'll come back to you within a day or two with ideas, pricing and a proof."));
kids.push(flag("“within a day or two” is invented — please confirm your real response time."));

kids.push(...item("Column 1 heading", "Turnaround"));
kids.push(...item("Column 1 text", "Most orders are proofed within 1–2 days and made within a week."));
kids.push(flag("Invented. This is a promise to customers — please replace with your real turnaround, and how far ahead people should order for a fixed date."));

kids.push(...item("Column 2 heading", "Bulk & Events"));
kids.push(...item("Column 2 text", "Weddings, classrooms and corporate gifting are very welcome — just mention quantities."));

kids.push(...item("Column 3 heading", "Not Sure Yet?"));
kids.push(...item("Column 3 text", "Send a rough idea anyway. Half of my favourite baskets started as “something like this?”"));
kids.push(...item("Link", "Browse past baskets on Instagram →"));

kids.push(H2("The order form"));
kids.push(note("Not built yet — it needs a form plugin. Suggested fields, cross out anything you don't want:"));
["Name", "Email", "Occasion", "Who it's for", "Rough budget", "Date needed",
 "Allergies or things to avoid", "Message for the card",
 "Photo upload (for inspiration or personalisation)", "Anything else"]
  .forEach((f) => kids.push(bullet(f)));

kids.push(rule());

/* ---------- error + search ---------- */
kids.push(H1("Error and search pages"));
kids.push(note("Rarely seen, but they should still sound like you."));
kids.push(...item("Page not found — heading", "This page wandered off"));
kids.push(...item("Page not found — text", "We couldn't find what you were looking for — but there are plenty of lovely things this way."));
kids.push(...item("Page not found — button", "Browse All Baskets"));
kids.push(...item("No search results", "No matches — try a different word, or browse all baskets."));

kids.push(rule());

/* ---------- still needed ---------- */
kids.push(H1("Details still needed"));
kids.push(note("Not copy exactly, but needed before the site can go live."));
["Email address for orders to arrive at",
 "Phone number — on the site, or not?",
 "Where you deliver — local only, nationwide post, collection?",
 "How people pay once a basket is agreed",
 "Lead time for dated occasions — weddings, graduations",
 "Minimum order for bulk or corporate, if there is one",
 "Business location — town or city, for local search",
 "Any allergen or food-safety wording you need included"]
  .forEach((t) => kids.push(bullet(t)));

kids.push(H2("Photographs still needed"));
["A teacher-appreciation basket — for the “For Teachers” tile",
 "A wedding or bridal basket — for the “Weddings” tile",
 "A thank-you basket — for the “Thank You” tile",
 "More basket photos — five so far, eight to twelve would fill the shop page",
 "A photo of you or your workspace — optional, for the About section"]
  .forEach((t) => kids.push(bullet(t)));
kids.push(note("Minimum 1600px on the longest edge; straight off a phone is fine. Leave a little room around the basket, because the site crops some images."));

/* ---------- build ---------- */
const doc = new Document({
  creator: "Happy Turtle Custom Gifts",
  title: "Happy Turtle — Website Copy",
  styles: {
    default: {
      document: { run: { font: "Calibri", size: 22 }, paragraph: { spacing: { line: 276 } } },
      heading1: { run: { font: "Calibri", size: 30, bold: true, color: "2E2B26" } },
      heading2: { run: { font: "Calibri", size: 24, bold: true, color: "4F6337" } },
    },
  },
  sections: [{
    properties: {
      page: {
        size: { width: 12240, height: 15840, orientation: PageOrientation.PORTRAIT },
        margin: { top: 1080, bottom: 1080, left: 1080, right: 1080 },
      },
    },
    children: kids,
  }],
});

Packer.toBuffer(doc).then((buf) => {
  fs.writeFileSync(process.argv[2], buf);
  console.log("  wrote " + process.argv[2] + " (" + (buf.length / 1024).toFixed(0) + " KB)");
});
