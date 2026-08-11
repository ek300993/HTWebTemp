<?php
/**
 * Title: Hero — Thoughtful Gifts
 * Slug: happy-turtle/hero
 * Categories: happy-turtle, featured
 * Description: Full-width opening section: headline, supporting line, a call to action, and a product photograph.
 * Keywords: hero, banner, header, intro
 * Viewport Width: 1400
 *
 * Layout is locked (templateLock: contentOnly) so the owner can rewrite every
 * word and swap the photo, but cannot pull the columns apart by accident.
 *
 * @package HappyTurtle
 */

$ht_img = static function ( $file ) {
	return esc_url( get_theme_file_uri( 'assets/images/' . $file ) );
};

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"0"},"blockGap":"0"}},"backgroundColor":"sand","layout":{"type":"constrained"},"templateLock":"contentOnly"} -->
<div class="wp-block-group alignfull has-sand-background-color has-background" style="padding-top:0;padding-bottom:0"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"0","left":"var:preset|spacing|xl"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"48%","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxl","bottom":"var:preset|spacing|xxl"},"blockGap":"var:preset|spacing|md"}}} -->
<div class="wp-block-column is-vertically-aligned-center" style="padding-top:var(--wp--preset--spacing--xxl);padding-bottom:var(--wp--preset--spacing--xxl);flex-basis:48%"><!-- wp:heading {"level":1,"style":{"typography":{"lineHeight":"1.05"}},"fontSize":"display"} -->
<h1 class="wp-block-heading has-display-font-size" style="line-height:1.05">Thoughtful Gifts,<br><em><mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color has-green-color">Made Just for You</mark></em></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"ink-soft","fontSize":"md","style":{"typography":{"lineHeight":"1.6"}}} -->
<p class="has-ink-soft-color has-text-color has-md-font-size" style="line-height:1.6">Beautifully curated gift baskets for life's<br>special moments. Hand-packed, just for you.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|md"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--md)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/shop/">Shop Gift Baskets</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="<?php echo $ht_img( 'new-home-welcome.jpg' ); ?>" alt="A hand-packed housewarming basket with a blanket, champagne and local treats" style="aspect-ratio:4/3;object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
