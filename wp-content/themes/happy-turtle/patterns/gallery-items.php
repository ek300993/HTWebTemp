<?php
/**
 * Title: Gallery — Individual Items
 * Slug: happy-turtle/gallery-items
 * Categories: happy-turtle
 * Description: A photo gallery of single made-to-order pieces — mugs, onesies, sweatshirts and other keepsakes.
 * Keywords: gallery, photos, items, personalised, custom, single
 * Viewport Width: 1400
 *
 * Same construction as gallery-baskets: a core Gallery block, six slots to start
 * with, grow it by selecting the gallery and pressing +.
 *
 * Every slot is a placeholder until photographs of the individual pieces arrive
 * — a real file rather than an empty image block, because WordPress strips an
 * <img> with no src and the row would collapse.
 *
 * @package HappyTurtle
 */

$ht_img = static function ( $file ) {
	return esc_url( get_theme_file_uri( 'assets/images/' . $file ) );
};

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxl","bottom":"var:preset|spacing|xxl"}}},"backgroundColor":"sage-mist","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-sage-mist-background-color has-background" style="padding-top:var(--wp--preset--spacing--xxl);padding-bottom:var(--wp--preset--spacing--xxl)"><!-- wp:heading {"textAlign":"center","fontSize":"xl"} -->
<h2 class="wp-block-heading has-text-align-center has-xl-font-size">Individual Items</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"ink-soft","fontSize":"sm"} -->
<p class="has-text-align-center has-ink-soft-color has-text-color has-sm-font-size">Not every gift needs a whole basket. These are single pieces made to order — etched mugs and glassware, baby onesies, sweatshirts and other personalised keepsakes.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","className":"is-style-heart-divider","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
<p class="has-text-align-center is-style-heart-divider" style="margin-bottom:var(--wp--preset--spacing--xl)">♥</p>
<!-- /wp:paragraph -->

<!-- wp:gallery {"columns":3,"linkTo":"none","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|md","left":"var:preset|spacing|md"}}}} -->
<figure class="wp-block-gallery has-nested-images columns-3 alignwide">
<?php

$ht_alts = array(
	__( 'An etched mug made to order', 'happy-turtle' ),
	__( 'A personalised baby onesie', 'happy-turtle' ),
	__( 'A custom sweatshirt', 'happy-turtle' ),
	__( 'Etched glassware made to order', 'happy-turtle' ),
	__( 'A personalised keepsake', 'happy-turtle' ),
	__( 'A made-to-order item from the studio', 'happy-turtle' ),
);

foreach ( $ht_alts as $ht_alt ) {
	echo '<!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"large","linkDestination":"none"} -->' . "\n"
		. '<figure class="wp-block-image size-large"><img src="' . $ht_img( 'placeholder.svg' ) . '" alt="' . esc_attr( $ht_alt ) . '" style="aspect-ratio:1;object-fit:cover"/></figure>' . "\n"
		. '<!-- /wp:image -->' . "\n\n";
}

?>
</figure>
<!-- /wp:gallery --></div>
<!-- /wp:group -->
