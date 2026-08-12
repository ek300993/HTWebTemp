<?php
/**
 * Title: About — Hi, I'm So Glad You're Here
 * Slug: happy-turtle/about-split
 * Categories: happy-turtle
 * Description: A half-image, half-text introduction with three small trust points alongside.
 * Keywords: about, story, introduction, maker, small business
 * Viewport Width: 1400
 *
 * Locked to content-only editing: the split is the whole point of the section,
 * so the owner gets the words and the photograph but not the scaffolding.
 *
 * @package HappyTurtle
 */

$ht_img = static function ( $file ) {
	return esc_url( get_theme_file_uri( 'assets/images/' . $file ) );
};

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"0"},"blockGap":"0"}},"backgroundColor":"sage-mist","layout":{"type":"constrained"},"templateLock":"contentOnly"} -->
<div class="wp-block-group alignfull has-sage-mist-background-color has-background" style="padding-top:0;padding-bottom:0"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"0","left":"var:preset|spacing|xl"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"42%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:42%"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"ht-about-card"} -->
<figure class="wp-block-image size-large ht-about-card"><img src="<?php echo $ht_img( 'brand-card.jpg' ); ?>" alt="A Happy Turtle Custom Gifts card, laid on a knitted blanket beside dried flowers"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","style":{"spacing":{"padding":{"top":"var:preset|spacing|lg","bottom":"var:preset|spacing|lg"}}}} -->
<div class="wp-block-column is-vertically-aligned-center" style="padding-top:var(--wp--preset--spacing--lg);padding-bottom:var(--wp--preset--spacing--lg)"><!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|lg","left":"var:preset|spacing|lg"}}}} -->
<div class="wp-block-columns"><!-- wp:column {"width":"58%"} -->
<div class="wp-block-column" style="flex-basis:58%"><!-- wp:heading {"fontSize":"xl"} -->
<h2 class="wp-block-heading has-xl-font-size">Hi, I'm so glad you're here!</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-heart-divider","style":{"spacing":{"margin":{"top":"var:preset|spacing|sm","bottom":"var:preset|spacing|md"}}}} -->
<p class="is-style-heart-divider" style="margin-top:var(--wp--preset--spacing--sm);margin-bottom:var(--wp--preset--spacing--md)">♥</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"ink-soft","fontSize":"sm"} -->
<p class="has-ink-soft-color has-text-color has-sm-font-size">At Happy Turtle Custom Gifts, I believe the best gifts come from the heart. Every basket is put together by hand, piece by piece — so whether you're marking a milestone or just want to make someone smile, it arrives feeling personal rather than picked off a shelf.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-script","style":{"spacing":{"margin":{"top":"var:preset|spacing|md"}}}} -->
<p class="is-style-script" style="margin-top:var(--wp--preset--spacing--md)">thank you for supporting my small business! ♥</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|md"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|sm"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:html -->
<span class="ht-icon" aria-hidden="true"><svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20.6C9.9 19 3.8 14.9 3.8 10.4A4.1 4.1 0 0 1 12 8.3a4.1 4.1 0 0 1 8.2 2.1c0 4.5-6.1 8.6-8.2 10.2Z"/></svg></span>
<!-- /wp:html -->

<!-- wp:paragraph {"fontSize":"sm","style":{"typography":{"lineHeight":"1.4"}}} -->
<p class="has-sm-font-size" style="line-height:1.4">Small Business<br>Big Heart</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|sm"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:html -->
<span class="ht-icon" aria-hidden="true"><svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 4S19 15 12.5 17.5C8 19.2 4.5 17 4.5 17S5 6.5 13 4.5c3.5-.9 7-.5 7-.5Z"/><path d="M4 20.5S6.5 13 12.5 9.5"/></svg></span>
<!-- /wp:html -->

<!-- wp:paragraph {"fontSize":"sm","style":{"typography":{"lineHeight":"1.4"}}} -->
<p class="has-sm-font-size" style="line-height:1.4">Eco-Conscious<br>Packaging</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|sm"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:html -->
<span class="ht-icon" aria-hidden="true"><svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M8.5 14.2a4.3 4.3 0 0 0 7 0"/><path d="M9 9.6h.01"/><path d="M15 9.6h.01"/></svg></span>
<!-- /wp:html -->

<!-- wp:paragraph {"fontSize":"sm","style":{"typography":{"lineHeight":"1.4"}}} -->
<p class="has-sm-font-size" style="line-height:1.4">Happy Customers<br>Are Everything</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
