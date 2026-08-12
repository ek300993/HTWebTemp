<?php
/**
 * Title: Browse Baskets — The Eight Kinds
 * Slug: happy-turtle/page-browse-baskets
 * Categories: happy-turtle
 * Description: One band per kind of basket — what tends to go in, what it's for, and a way to ask about it — with a jump-to row at the top.
 * Keywords: browse, categories, occasions, baskets, what's inside
 * Viewport Width: 1400
 *
 * Deliberately not locked. This is the page most likely to grow: a new kind of
 * basket means duplicating a band (three-dot menu → Duplicate) and changing the
 * words, and a second example photograph means selecting the image and using
 * Duplicate on that.
 *
 * Three things are doing the work here, and they're worth keeping if the page is
 * rearranged. The page is long — eight bands is five or six screens — so it
 * opens with a row of jump links rather than asking anyone to scroll and hope.
 * The bands alternate cream and sand as well as photograph left and right, so
 * two neighbours never read as one block. And each band ends with its own way
 * in to the contact form, because the point at which someone decides is the
 * point at which they've just finished reading about their occasion.
 *
 * Each heading carries an anchor — #new-baby, #new-home and so on — used both by
 * the jump links here and by the occasion tiles on the homepage, which link
 * straight to the matching band rather than to the occasion archive (empty until
 * baskets are published against it). If you rename a heading, keep its anchor.
 *
 * @package HappyTurtle
 */

$ht_img = static function ( $file ) {
	return esc_url( get_theme_file_uri( 'assets/images/' . $file ) );
};

/**
 * The eight kinds, in the order they appear.
 *
 * `lead` is the sentence that sells it, `includes` the scannable specifics.
 * The four items set two-up beside the photograph, so keep them to four and
 * keep them short — a fifth leaves an orphan on its own row, and a long phrase
 * wraps and pulls the block taller than the picture it sits next to.
 */
$ht_kinds = array(
	array(
		'anchor'   => 'new-baby',
		'title'    => __( 'New Baby', 'happy-turtle' ),
		'lead'     => __( 'Something for the baby, and something for the parents who are running on very little sleep.', 'happy-turtle' ),
		'includes' => array(
			__( 'Personalised blankets and swaddles', 'happy-turtle' ),
			__( 'Bodysuits, bibs and hooded towels', 'happy-turtle' ),
			__( 'A keepsake basket or name letterboard', 'happy-turtle' ),
			__( 'Treats for the three in the morning shift', 'happy-turtle' ),
		),
		'cta'      => __( 'Ask about a new baby basket', 'happy-turtle' ),
		'image'    => 'new-baby-elephant.jpg',
		'alt'      => __( 'A personalised new baby basket with a felt elephant', 'happy-turtle' ),
	),
	array(
		'anchor'   => 'new-home',
		'title'    => __( 'New Home', 'happy-turtle' ),
		'lead'     => __( 'A proper welcome to a new front door — the things that make a place feel lived in on the very first night.', 'happy-turtle' ),
		'includes' => array(
			__( 'A throw for the new sofa', 'happy-turtle' ),
			__( 'Something to toast with', 'happy-turtle' ),
			__( 'Treats from around the neighbourhood', 'happy-turtle' ),
			__( 'A practical piece that outlasts the boxes', 'happy-turtle' ),
		),
		'cta'      => __( 'Ask about a new home basket', 'happy-turtle' ),
		'image'    => 'new-home-welcome.jpg',
		'alt'      => __( 'A housewarming basket with a blanket, champagne and local treats', 'happy-turtle' ),
	),
	array(
		'anchor'   => 'graduation',
		'title'    => __( 'Graduation', 'happy-turtle' ),
		'lead'     => __( 'Built around where they are headed next, rather than only what they have just finished.', 'happy-turtle' ),
		'includes' => array(
			__( 'A personalised tumbler', 'happy-turtle' ),
			__( 'A crate that stands up on a dorm desk', 'happy-turtle' ),
			__( 'A Class of letterboard for the photographs', 'happy-turtle' ),
			__( 'The practical things left off the packing list', 'happy-turtle' ),
		),
		'cta'      => __( 'Ask about a graduation basket', 'happy-turtle' ),
		'image'    => 'graduation-crate.jpg',
		'alt'      => __( 'A graduation crate with a letterboard and personalised tumbler', 'happy-turtle' ),
	),
	array(
		'anchor'   => 'weddings',
		'title'    => __( 'Weddings', 'happy-turtle' ),
		'lead'     => __( 'For the couple, for the wedding party, or for the people who quietly made the day happen.', 'happy-turtle' ),
		'includes' => array(
			__( 'Engagement and shower gifts', 'happy-turtle' ),
			__( 'Thank-you baskets for parents and attendants', 'happy-turtle' ),
			__( 'Personalised keepsakes for the morning of', 'happy-turtle' ),
			__( 'Matching sets for a whole party', 'happy-turtle' ),
		),
		'cta'      => __( 'Ask about a wedding basket', 'happy-turtle' ),
		'image'    => 'placeholder.svg',
		'alt'      => __( 'A wedding gift basket', 'happy-turtle' ),
	),
	array(
		'anchor'   => 'retirement',
		'title'    => __( 'Retirement', 'happy-turtle' ),
		'lead'     => __( 'A send-off that looks forward rather than back, built around what they finally have time for.', 'happy-turtle' ),
		'includes' => array(
			__( 'Pieces for the hobby they have been putting off', 'happy-turtle' ),
			__( 'Travel and garden things', 'happy-turtle' ),
			__( 'Personalised glassware or a keepsake box', 'happy-turtle' ),
			__( 'A nod to the years and the people', 'happy-turtle' ),
		),
		'cta'      => __( 'Ask about a retirement basket', 'happy-turtle' ),
		'image'    => 'placeholder.svg',
		'alt'      => __( 'A retirement gift basket', 'happy-turtle' ),
	),
	array(
		'anchor'   => 'birthday',
		'title'    => __( 'Birthday', 'happy-turtle' ),
		'lead'     => __( 'Built entirely around one person — their colours, their snacks, the hobby they never stop talking about.', 'happy-turtle' ),
		'includes' => array(
			__( 'Milestone numbers and personalised names', 'happy-turtle' ),
			__( 'The treats they would never buy themselves', 'happy-turtle' ),
			__( 'Something for the hobby', 'happy-turtle' ),
			__( 'A card message in your own words', 'happy-turtle' ),
		),
		'cta'      => __( 'Ask about a birthday basket', 'happy-turtle' ),
		'image'    => 'placeholder.svg',
		'alt'      => __( 'A birthday gift basket', 'happy-turtle' ),
	),
	array(
		'anchor'   => 'teachers',
		'title'    => __( 'For Teachers', 'happy-turtle' ),
		'lead'     => __( 'Appreciation for one teacher or a whole staff room, presented so it looks like a gift rather than an afterthought.', 'happy-turtle' ),
		'includes' => array(
			__( 'Personalised mugs and tumblers', 'happy-turtle' ),
			__( 'Classroom-friendly treats', 'happy-turtle' ),
			__( 'Gift cards, properly presented', 'happy-turtle' ),
			__( 'Matching sets for a whole team', 'happy-turtle' ),
		),
		'cta'      => __( 'Ask about a teacher basket', 'happy-turtle' ),
		'image'    => 'placeholder.svg',
		'alt'      => __( 'A teacher appreciation gift basket', 'happy-turtle' ),
	),
	array(
		'anchor'   => 'thinking-of-you',
		'title'    => __( 'Thinking of You', 'happy-turtle' ),
		'lead'     => __( 'For the moments that do not have a card aisle — get well, sympathy, a hard week, or simply because.', 'happy-turtle' ),
		'includes' => array(
			__( 'Soft things and warm drinks', 'happy-turtle' ),
			__( 'Something to read', 'happy-turtle' ),
			__( 'Comfort food that keeps', 'happy-turtle' ),
			__( 'A handwritten note in your words', 'happy-turtle' ),
		),
		'cta'      => __( 'Ask about a thinking of you basket', 'happy-turtle' ),
		'image'    => 'placeholder.svg',
		'alt'      => __( 'A thinking of you gift basket', 'happy-turtle' ),
	),
);

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl"},"blockGap":"var:preset|spacing|xs"}},"backgroundColor":"cream","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-cream-background-color has-background" style="padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl)"><!-- wp:paragraph {"align":"center","className":"is-style-eyebrow"} -->
<p class="has-text-align-center is-style-eyebrow">Eight Kinds of Basket</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","textColor":"ink-soft"} -->
<p class="has-text-align-center has-ink-soft-color has-text-color">Nothing here is a fixed package. These are the kinds of basket I'm asked for most often and the sorts of things that tend to go in — treat them as a starting point, and we'll build yours around the person it's for.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"align":"wide","className":"ht-chips","style":{"spacing":{"blockGap":"var:preset|spacing|xs","margin":{"top":"var:preset|spacing|lg"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
<div class="wp-block-group alignwide ht-chips" style="margin-top:var(--wp--preset--spacing--lg)">
<?php foreach ( $ht_kinds as $ht_kind ) : ?>
<!-- wp:paragraph {"fontSize":"xs"} -->
<p class="has-xs-font-size"><a href="#<?php echo esc_attr( $ht_kind['anchor'] ); ?>"><?php echo esc_html( $ht_kind['title'] ); ?></a></p>
<!-- /wp:paragraph -->
<?php endforeach; ?>
</div>
<!-- /wp:group -->

<?php
/*
 * Back to top, pinned to the bottom-right corner.
 *
 * It sits inside this group rather than as a section of its own because it is
 * position: fixed — where it lives in the document makes no difference to where
 * it lands, and a stray block between two full-bleed bands would put a stripe of
 * page background between them.
 *
 * `#top` with no element to match is the HTML spec's way of saying "the top of
 * the document"; every browser honours it, so there's no id to keep in sync.
 */
?>
<!-- wp:html -->
<p class="ht-to-top"><a href="#top" aria-label="Back to top"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m6 14 6-6 6 6"/></svg></a></p>
<!-- /wp:html --></div>
<!-- /wp:group -->

<?php

$ht_index = 0;

foreach ( $ht_kinds as $ht_kind ) :

	$ht_flip = (bool) ( $ht_index % 2 );          // Photograph right on every other band.
	$ht_bg   = $ht_flip ? 'sand' : 'cream';
	++$ht_index;

	$ht_media = '<!-- wp:column {"verticalAlignment":"center","width":"42%","className":"ht-browse-media"} -->' . "\n"
		. '<div class="wp-block-column is-vertically-aligned-center ht-browse-media" style="flex-basis:42%"><!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"large","linkDestination":"none"} -->' . "\n"
		. '<figure class="wp-block-image size-large"><img src="' . $ht_img( $ht_kind['image'] ) . '" alt="' . esc_attr( $ht_kind['alt'] ) . '" style="aspect-ratio:4/3;object-fit:cover"/></figure>' . "\n"
		. '<!-- /wp:image --></div>' . "\n"
		. '<!-- /wp:column -->';

	$ht_items = '';
	foreach ( $ht_kind['includes'] as $ht_item ) {
		$ht_items .= '<!-- wp:list-item -->' . "\n" . '<li>' . esc_html( $ht_item ) . '</li>' . "\n" . '<!-- /wp:list-item -->' . "\n\n";
	}

	$ht_text = '<!-- wp:column {"verticalAlignment":"center"} -->' . "\n"
		. '<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"level":2,"anchor":"' . esc_attr( $ht_kind['anchor'] ) . '","fontSize":"xl"} -->' . "\n"
		. '<h2 class="wp-block-heading has-xl-font-size" id="' . esc_attr( $ht_kind['anchor'] ) . '">' . esc_html( $ht_kind['title'] ) . '</h2>' . "\n"
		. '<!-- /wp:heading -->' . "\n\n"
		. '<!-- wp:paragraph {"textColor":"ink-soft"} -->' . "\n"
		. '<p class="has-ink-soft-color has-text-color">' . esc_html( $ht_kind['lead'] ) . '</p>' . "\n"
		. '<!-- /wp:paragraph -->' . "\n\n"
		. '<!-- wp:paragraph {"className":"is-style-eyebrow","style":{"spacing":{"margin":{"top":"var:preset|spacing|md"}}}} -->' . "\n"
		. '<p class="is-style-eyebrow" style="margin-top:var(--wp--preset--spacing--md)">' . esc_html__( 'Often includes', 'happy-turtle' ) . '</p>' . "\n"
		. '<!-- /wp:paragraph -->' . "\n\n"
		. '<!-- wp:list {"className":"is-style-plain ht-includes","fontSize":"sm"} -->' . "\n"
		. '<ul class="wp-block-list is-style-plain ht-includes has-sm-font-size">' . "\n" . $ht_items . '</ul>' . "\n"
		. '<!-- /wp:list -->' . "\n\n"
		. '<!-- wp:paragraph {"className":"ht-more","fontSize":"sm","style":{"spacing":{"margin":{"top":"var:preset|spacing|md"}}}} -->' . "\n"
		. '<p class="ht-more has-sm-font-size" style="margin-top:var(--wp--preset--spacing--md)"><a href="/contact/">' . esc_html( $ht_kind['cta'] ) . ' →</a></p>' . "\n"
		. '<!-- /wp:paragraph --></div>' . "\n"
		. '<!-- /wp:column -->';

	echo '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl"}}},"backgroundColor":"' . $ht_bg . '","layout":{"type":"constrained"}} -->' . "\n"
		. '<div class="wp-block-group alignfull has-' . $ht_bg . '-background-color has-background" style="padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl)">'
		. '<!-- wp:columns {"verticalAlignment":"center","align":"wide","className":"ht-browse","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|lg","left":"var:preset|spacing|xl"}}}} -->' . "\n"
		. '<div class="wp-block-columns alignwide are-vertically-aligned-center ht-browse">'
		. ( $ht_flip ? $ht_text . "\n\n" . $ht_media : $ht_media . "\n\n" . $ht_text )
		. '</div>' . "\n"
		. '<!-- /wp:columns --></div>' . "\n"
		. '<!-- /wp:group -->' . "\n\n";

endforeach;
