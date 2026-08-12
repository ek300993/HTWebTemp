<?php
/**
 * Title: Gallery — Baskets
 * Slug: happy-turtle/gallery-baskets
 * Categories: happy-turtle
 * Description: A photo gallery of finished baskets. Add as many as you like — the grid reflows on its own.
 * Keywords: gallery, photos, baskets, portfolio, examples
 * Viewport Width: 1400
 *
 * A core Gallery block rather than a hand-built grid, because adding to a
 * Gallery is one click: select it, press +, upload. The grid reflows itself, so
 * there is no column count to retune and no risk of a half-empty row.
 *
 * It ships with eight slots — the photographs there are, plus a few
 * placeholders — and is meant to grow to fifteen or twenty. Every image is
 * cropped square so the rows stay even whatever shape the originals are.
 *
 * @package HappyTurtle
 */

$ht_img = static function ( $file ) {
	return esc_url( get_theme_file_uri( 'assets/images/' . $file ) );
};

/**
 * One image inside the gallery.
 *
 * @param string $img Image URL.
 * @param string $alt Alt text.
 */
$ht_photo = static function ( $img, $alt ) {
	echo '<!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"large","linkDestination":"none"} -->' . "\n"
		. '<figure class="wp-block-image size-large"><img src="' . $img . '" alt="' . $alt . '" style="aspect-ratio:1;object-fit:cover"/></figure>' . "\n"
		. '<!-- /wp:image -->' . "\n\n";
};

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxl","bottom":"var:preset|spacing|xxl"}}},"backgroundColor":"cream","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-cream-background-color has-background" style="padding-top:var(--wp--preset--spacing--xxl);padding-bottom:var(--wp--preset--spacing--xxl)"><!-- wp:heading {"textAlign":"center","fontSize":"xl"} -->
<h2 class="wp-block-heading has-text-align-center has-xl-font-size">The Baskets</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"ink-soft","fontSize":"sm"} -->
<p class="has-text-align-center has-ink-soft-color has-text-color has-sm-font-size">A mix of what has left the studio — different occasions, different budgets, and not one of them made twice.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","className":"is-style-heart-divider","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
<p class="has-text-align-center is-style-heart-divider" style="margin-bottom:var(--wp--preset--spacing--xl)">♥</p>
<!-- /wp:paragraph -->

<!-- wp:gallery {"columns":4,"linkTo":"none","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|md","left":"var:preset|spacing|md"}}}} -->
<figure class="wp-block-gallery has-nested-images columns-4 alignwide">
<?php

$ht_photo( $ht_img( 'new-home-welcome.jpg' ), esc_attr__( 'A housewarming basket with a blanket, champagne and local treats', 'happy-turtle' ) );
$ht_photo( $ht_img( 'new-baby-elephant.jpg' ), esc_attr__( 'A personalised new baby basket with a felt elephant', 'happy-turtle' ) );
$ht_photo( $ht_img( 'graduation-crate.jpg' ), esc_attr__( 'A graduation crate with a letterboard and personalised tumbler', 'happy-turtle' ) );
$ht_photo( $ht_img( 'new-baby-letterboard.jpg' ), esc_attr__( 'A new baby basket with a personalised letterboard', 'happy-turtle' ) );
$ht_photo( $ht_img( 'graduation-class-2026.jpg' ), esc_attr__( 'A Class of 2026 basket with an embroidered bear', 'happy-turtle' ) );
$ht_photo( $ht_img( 'placeholder.svg' ), esc_attr__( 'A basket from the studio', 'happy-turtle' ) );
$ht_photo( $ht_img( 'placeholder.svg' ), esc_attr__( 'A basket from the studio', 'happy-turtle' ) );
$ht_photo( $ht_img( 'placeholder.svg' ), esc_attr__( 'A basket from the studio', 'happy-turtle' ) );

?>
</figure>
<!-- /wp:gallery --></div>
<!-- /wp:group -->
