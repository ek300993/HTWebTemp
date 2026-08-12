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
 * The column widths are tuned to one string. "Hi, I'm so glad you're here!" at
 * the xl size wants 439px, so the text column is 70% of a text half that starts
 * at 40/60 with an lg gap — which lands it a comfortable 54px clear on a desktop
 * and holds one line down to about 1150px. The other 30% is what keeps "Happy
 * Customers / Are Everything" on two lines rather than three.
 *
 * A longer greeting wraps again. If that heading is rewritten and the wrap
 * matters, the levers in order of least damage are the outer gap, then the
 * image column, then the inner split — and check the trust points after each,
 * because they run out of room before anything visibly breaks.
 *
 * @package HappyTurtle
 */

$ht_img = static function ( $file ) {
	return esc_url( get_theme_file_uri( 'assets/images/' . $file ) );
};

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"0"},"blockGap":"0"}},"backgroundColor":"sage-mist","layout":{"type":"constrained"},"templateLock":"contentOnly"} -->
<div class="wp-block-group alignfull has-sage-mist-background-color has-background" style="padding-top:0;padding-bottom:0"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"0","left":"var:preset|spacing|lg"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"ht-about-card"} -->
<figure class="wp-block-image size-large ht-about-card"><img src="<?php echo $ht_img( 'brand-card.jpg' ); ?>" alt="A Happy Turtle Custom Gifts card, laid on a knitted blanket beside dried flowers"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","style":{"spacing":{"padding":{"top":"var:preset|spacing|lg","bottom":"var:preset|spacing|lg"}}}} -->
<div class="wp-block-column is-vertically-aligned-center" style="padding-top:var(--wp--preset--spacing--lg);padding-bottom:var(--wp--preset--spacing--lg)"><!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|lg","left":"var:preset|spacing|md"}}}} -->
<div class="wp-block-columns"><!-- wp:column {"width":"70%"} -->
<div class="wp-block-column" style="flex-basis:70%"><!-- wp:heading {"fontSize":"xl"} -->
<h2 class="wp-block-heading has-xl-font-size">Hi, I'm so glad you're here!</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-heart-divider","style":{"spacing":{"margin":{"top":"var:preset|spacing|sm","bottom":"var:preset|spacing|md"}}}} -->
<p class="is-style-heart-divider" style="margin-top:var(--wp--preset--spacing--sm);margin-bottom:var(--wp--preset--spacing--md)">♥</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"ink-soft","fontSize":"sm"} -->
<p class="has-ink-soft-color has-text-color has-sm-font-size">At Happy Turtle Custom Gifts, I believe the best gifts come from the heart. Every basket is curated and tailored specifically to the recipient — so whether you're celebrating a milestone or just want to make someone smile, I'm here to help you create something meaningful and truly one of a kind.</p>
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
<span class="ht-icon" aria-hidden="true"><svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5.5 8.5H15V15a4 4 0 0 1-4 4H9.5a4 4 0 0 1-4-4V8.5Z"/><path d="M15 10.5h1.6a2.4 2.4 0 0 1 0 4.8H15"/><path d="M9 5.8c0-1.1 1-1.1 1-2.2"/><path d="M12.4 5.8c0-1.1 1-1.1 1-2.2"/></svg></span>
<!-- /wp:html -->

<!-- wp:paragraph {"fontSize":"sm","style":{"typography":{"lineHeight":"1.4"}}} -->
<p class="has-sm-font-size" style="line-height:1.4">Practical and<br>Functional</p>
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
