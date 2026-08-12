<?php
/**
 * Title: Hero — Thoughtful Gifts
 * Slug: happy-turtle/hero
 * Categories: happy-turtle, featured
 * Description: Full-width opening section: a banner photograph that dissolves into a calm field on the left, with the headline, supporting line and call to action sitting on it.
 * Keywords: hero, banner, header, intro
 * Viewport Width: 1400
 *
 * Layout is locked (templateLock: contentOnly) so the owner can rewrite every
 * word and swap the photographs, but cannot pull the section apart.
 *
 * The banner is pre-blended by scripts/make-hero-banner.py: the photograph sits
 * on the right and dissolves leftwards into a wash made from its own colours,
 * so the words have somewhere clean to sit.
 *
 * One image at every width. On a phone the band can't hold the words on top of
 * a 2.2:1 picture, so the stylesheet drops the banner to a full-width strip
 * along the bottom of the section with the copy above it on flat sand — same
 * file, different arrangement. See README → Photography.
 *
 * @package HappyTurtle
 */

$ht_img = static function ( $file ) {
	return esc_url( get_theme_file_uri( 'assets/images/' . $file ) );
};

?>
<!-- wp:cover {"url":"<?php echo $ht_img( 'hero-banner.jpg' ); ?>","dimRatio":0,"customOverlayColor":"#F2ECE1","isUserOverlayColor":true,"minHeight":620,"focalPoint":{"x":1,"y":0.5},"contentPosition":"center left","isDark":false,"align":"full","className":"ht-hero","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}},"templateLock":"contentOnly"} -->
<div class="wp-block-cover alignfull is-light has-custom-content-position is-position-center-left ht-hero" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:620px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim" style="background-color:#F2ECE1"></span><img class="wp-block-cover__image-background" alt="" src="<?php echo $ht_img( 'hero-banner.jpg' ); ?>" style="object-position:100% 50%" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:group {"className":"ht-hero-copy","style":{"spacing":{"blockGap":"var:preset|spacing|md"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group ht-hero-copy"><!-- wp:heading {"level":1,"style":{"typography":{"lineHeight":"1.05"}},"fontSize":"display"} -->
<h1 class="wp-block-heading has-display-font-size" style="line-height:1.05">Thoughtful Gifts,<br><em><mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color has-green-color">Made Just for You</mark></em></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"ink-soft","fontSize":"md","style":{"typography":{"lineHeight":"1.6"}}} -->
<p class="has-ink-soft-color has-text-color has-md-font-size" style="line-height:1.6">Beautifully curated gift baskets for life's<br>special moments. Hand-packed, just for you.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|md"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--md)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/browse-baskets/">Shop Gift Baskets</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->
