<?php
/**
 * Title: Occasion Grid — Baskets for Every Occasion
 * Slug: happy-turtle/occasion-grid
 * Categories: happy-turtle
 * Description: Seven occasion tiles linking through to the Browse Baskets page, with a browse-all button.
 * Keywords: occasions, categories, grid, collections
 * Viewport Width: 1400
 *
 * Left unlocked on purpose: occasions are the thing on the homepage the owner is
 * most likely to add to or reorder over time.
 *
 * minimumColumnWidth is 9.5rem so that seven tiles land in exactly seven columns
 * at wideSize (1240px) — WordPress grids use auto-fill, which keeps empty
 * trailing tracks, so this number has to match the tile count. Change one,
 * retune the other: the sum is (tiles x width) + (gaps x 1.5rem) <= 1240px.
 *
 * Tiles link to the matching section of the Browse Baskets page rather than to
 * the occasion archive, so a tile is never a dead end while an occasion has no
 * baskets published against it yet.
 *
 * Tiles without a photograph yet fall back to placeholder.svg. All images are
 * cropped to a common 4:3 so the row stays even whatever gets uploaded.
 *
 * @package HappyTurtle
 */

$ht_img = static function ( $file ) {
	return esc_url( get_theme_file_uri( 'assets/images/' . $file ) );
};

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxl","bottom":"var:preset|spacing|xxl"}}},"backgroundColor":"cream","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-cream-background-color has-background" style="padding-top:var(--wp--preset--spacing--xxl);padding-bottom:var(--wp--preset--spacing--xxl)"><!-- wp:paragraph {"align":"center","className":"is-style-eyebrow"} -->
<p class="has-text-align-center is-style-eyebrow">Handmade &amp; Custom</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","fontSize":"xxl"} -->
<h2 class="wp-block-heading has-text-align-center has-xxl-font-size">Baskets for Every Occasion</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"is-style-heart-divider","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
<p class="has-text-align-center is-style-heart-divider" style="margin-bottom:var(--wp--preset--spacing--xl)">♥</p>
<!-- /wp:paragraph -->

<!-- wp:group {"align":"wide","className":"ht-tile ht-occasions","style":{"spacing":{"blockGap":"var:preset|spacing|md"}},"layout":{"type":"grid","minimumColumnWidth":"9.5rem"}} -->
<div class="wp-block-group alignwide ht-tile ht-occasions"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|sm"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"large","linkDestination":"custom"} -->
<figure class="wp-block-image size-large"><a href="/browse-baskets/#teachers"><img src="<?php echo $ht_img( 'placeholder.svg' ); ?>" alt="A teacher appreciation gift basket" style="aspect-ratio:4/3;object-fit:cover"/></a></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"align":"center","fontSize":"base"} -->
<p class="has-text-align-center has-base-font-size"><a href="/browse-baskets/#teachers">For Teachers</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|sm"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"large","linkDestination":"custom"} -->
<figure class="wp-block-image size-large"><a href="/browse-baskets/#weddings"><img src="<?php echo $ht_img( 'placeholder.svg' ); ?>" alt="A wedding gift basket" style="aspect-ratio:4/3;object-fit:cover"/></a></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"align":"center","fontSize":"base"} -->
<p class="has-text-align-center has-base-font-size"><a href="/browse-baskets/#weddings">Weddings</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|sm"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"large","linkDestination":"custom"} -->
<figure class="wp-block-image size-large"><a href="/browse-baskets/#new-home"><img src="<?php echo $ht_img( 'new-home-welcome.jpg' ); ?>" alt="A housewarming basket with a blanket, champagne and local treats" style="aspect-ratio:4/3;object-fit:cover"/></a></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"align":"center","fontSize":"base"} -->
<p class="has-text-align-center has-base-font-size"><a href="/browse-baskets/#new-home">New Home</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|sm"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"large","linkDestination":"custom"} -->
<figure class="wp-block-image size-large"><a href="/browse-baskets/#new-baby"><img src="<?php echo $ht_img( 'new-baby-elephant.jpg' ); ?>" alt="A personalised new baby basket with a felt elephant" style="aspect-ratio:4/3;object-fit:cover"/></a></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"align":"center","fontSize":"base"} -->
<p class="has-text-align-center has-base-font-size"><a href="/browse-baskets/#new-baby">New Baby</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|sm"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"large","linkDestination":"custom"} -->
<figure class="wp-block-image size-large"><a href="/browse-baskets/#graduation"><img src="<?php echo $ht_img( 'graduation-crate.jpg' ); ?>" alt="A graduation crate with a letterboard and personalised tumbler" style="aspect-ratio:4/3;object-fit:cover"/></a></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"align":"center","fontSize":"base"} -->
<p class="has-text-align-center has-base-font-size"><a href="/browse-baskets/#graduation">Graduation</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|sm"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"large","linkDestination":"custom"} -->
<figure class="wp-block-image size-large"><a href="/browse-baskets/#birthday"><img src="<?php echo $ht_img( 'placeholder.svg' ); ?>" alt="A birthday gift basket" style="aspect-ratio:4/3;object-fit:cover"/></a></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"align":"center","fontSize":"base"} -->
<p class="has-text-align-center has-base-font-size"><a href="/browse-baskets/#birthday">Birthday</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|sm"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"large","linkDestination":"custom"} -->
<figure class="wp-block-image size-large"><a href="/browse-baskets/#retirement"><img src="<?php echo $ht_img( 'placeholder.svg' ); ?>" alt="A retirement gift basket" style="aspect-ratio:4/3;object-fit:cover"/></a></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"align":"center","fontSize":"base"} -->
<p class="has-text-align-center has-base-font-size"><a href="/browse-baskets/#retirement">Retirement</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|xl"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--xl)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/browse-baskets/">Browse All Baskets</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
