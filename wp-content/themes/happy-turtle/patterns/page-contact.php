<?php
/**
 * Title: Contact — Start an Order
 * Slug: happy-turtle/page-contact
 * Categories: happy-turtle
 * Description: Contact page with email, phone and the enquiry form.
 * Keywords: contact, order, form, enquiry, get in touch, email, phone
 * Viewport Width: 1400
 *
 * The form itself is [happy_turtle_contact_form], rendered by the Happy Turtle
 * Gift Baskets plugin. Four fields, a nonce, a honeypot and a rate limit; it
 * emails on to whatever address is set at Settings → General → "Gift basket
 * enquiries". If the shortcode ever shows as plain text on the page, the plugin
 * has been deactivated.
 *
 * A form plugin is still the upgrade path the day file uploads matter —
 * customers sending reference photographs is the obvious one. Delete the
 * shortcode block and drop the plugin's form block in its place.
 *
 * The wrapper carries id="order-form" because the form redirects back to that
 * anchor after sending, so the confirmation is on screen rather than a page
 * scroll away.
 *
 * @package HappyTurtle
 */

?>
<!-- wp:group {"align":"full","className":"ht-page-header","style":{"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl"}}},"backgroundColor":"sand","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull ht-page-header has-sand-background-color has-background" style="padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xl)"><!-- wp:paragraph {"align":"center","className":"is-style-eyebrow"} -->
<p class="has-text-align-center is-style-eyebrow">Let's Make Something</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":1,"fontSize":"xxl"} -->
<h1 class="wp-block-heading has-text-align-center has-xxl-font-size">Start an Order</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"is-style-heart-divider"} -->
<p class="has-text-align-center is-style-heart-divider">♥</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","textColor":"ink-soft","fontSize":"sm"} -->
<p class="has-text-align-center has-ink-soft-color has-text-color has-sm-font-size">Tell me a little about the basket you have in mind and I'll come back to you with ideas, pricing and next steps.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xxl"},"blockGap":"var:preset|spacing|xl"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--xl);padding-bottom:var(--wp--preset--spacing--xxl)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|md"}},"layout":{"type":"grid","minimumColumnWidth":"16rem"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":6} -->
<h6 class="wp-block-heading has-text-align-center">Email</h6>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","fontSize":"sm"} -->
<p class="has-text-align-center has-sm-font-size"><a href="mailto:happyturtlecustomgifts@gmail.com">happyturtlecustomgifts@gmail.com</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":6} -->
<h6 class="wp-block-heading has-text-align-center">Phone</h6>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","fontSize":"sm"} -->
<p class="has-text-align-center has-sm-font-size"><a href="tel:+17817899219">(781) 789-9219</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"anchor":"order-form","style":{"spacing":{"padding":{"top":"var:preset|spacing|lg","bottom":"var:preset|spacing|lg","left":"var:preset|spacing|lg","right":"var:preset|spacing|lg"},"blockGap":"var:preset|spacing|sm"},"border":{"radius":"4px","color":"var:preset|color|sage-mist","width":"1px"}},"backgroundColor":"cream","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-cream-background-color has-background" id="order-form" style="border-color:var(--wp--preset--color--sage-mist);border-width:1px;border-radius:4px;padding-top:var(--wp--preset--spacing--lg);padding-right:var(--wp--preset--spacing--lg);padding-bottom:var(--wp--preset--spacing--lg);padding-left:var(--wp--preset--spacing--lg)"><!-- wp:heading {"level":2,"fontSize":"lg"} -->
<h2 class="wp-block-heading has-lg-font-size">Tell me about it</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"ink-soft","fontSize":"sm","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|md"}}}} -->
<p class="has-ink-soft-color has-text-color has-sm-font-size" style="margin-bottom:var(--wp--preset--spacing--md)">Just enough to get us started — I'll follow up with a short form asking for the details.</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[happy_turtle_contact_form]
<!-- /wp:shortcode --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|md"}},"layout":{"type":"grid","minimumColumnWidth":"14rem"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|xs"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":6} -->
<h6 class="wp-block-heading">Turnaround</h6>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"ink-soft","fontSize":"sm"} -->
<p class="has-ink-soft-color has-text-color has-sm-font-size">Most orders require a 1-2 week minimum, depending on the level of customization required.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|xs"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":6} -->
<h6 class="wp-block-heading">Bulk &amp; Events</h6>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"ink-soft","fontSize":"sm"} -->
<p class="has-ink-soft-color has-text-color has-sm-font-size">Weddings, classrooms and corporate gifting are very welcome — just mention quantities.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|xs"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":6} -->
<h6 class="wp-block-heading">Not Sure Yet?</h6>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"ink-soft","fontSize":"sm"} -->
<p class="has-ink-soft-color has-text-color has-sm-font-size">Send a rough idea anyway. Half of my favourite baskets started as "something like this?"</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"fontSize":"sm","style":{"spacing":{"margin":{"top":"var:preset|spacing|sm"}}}} -->
<p class="has-sm-font-size" style="margin-top:var(--wp--preset--spacing--sm)"><a href="https://www.instagram.com/happy_turtle_customgifts/" target="_blank" rel="noreferrer noopener">Browse past baskets on Instagram →</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
