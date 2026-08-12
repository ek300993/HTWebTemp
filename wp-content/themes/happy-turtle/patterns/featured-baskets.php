<?php
/**
 * Title: Featured Baskets — Latest from the Studio
 * Slug: happy-turtle/featured-baskets
 * Categories: happy-turtle
 * Description: A self-updating row of the most recent baskets. Nothing to edit — add a basket and it appears here.
 * Keywords: baskets, products, query, latest, shop, gallery
 * Viewport Width: 1400
 *
 * This is the pattern that does the most work for the owner: it is a Query Loop
 * over the "basket" post type, so publishing a basket updates the page with no
 * page editing at all.
 *
 * It lives on the Gallery page rather than the homepage — the homepage sends
 * people to Browse Baskets to pick an occasion, and the Gallery is where the
 * actual work is shown.
 *
 * @package HappyTurtle
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxl","bottom":"var:preset|spacing|xxl"}}},"backgroundColor":"sand","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-sand-background-color has-background" style="padding-top:var(--wp--preset--spacing--xxl);padding-bottom:var(--wp--preset--spacing--xxl)"><!-- wp:heading {"textAlign":"center","fontSize":"xl"} -->
<h2 class="wp-block-heading has-text-align-center has-xl-font-size">Recently Made</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"ink-soft","fontSize":"sm"} -->
<p class="has-text-align-center has-ink-soft-color has-text-color has-sm-font-size">Here are a few baskets from the studio. Each one is customized and hand-selected to order — use these as a starting point for yours.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","className":"is-style-heart-divider","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
<p class="has-text-align-center is-style-heart-divider" style="margin-bottom:var(--wp--preset--spacing--xl)">♥</p>
<!-- /wp:paragraph -->

<!-- wp:query {"queryId":0,"query":{"perPage":4,"pages":1,"offset":0,"postType":"basket","order":"desc","orderBy":"date","inherit":false},"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-query alignwide"><!-- wp:post-template {"className":"ht-tile","style":{"spacing":{"blockGap":"var:preset|spacing|md"}},"layout":{"type":"grid","minimumColumnWidth":"16rem"}} -->
<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"1","style":{"border":{"radius":"4px"}}} /-->

<!-- wp:post-title {"textAlign":"center","level":3,"isLink":true,"style":{"spacing":{"margin":{"top":"var:preset|spacing|sm"}}},"fontSize":"base"} /-->

<!-- wp:post-excerpt {"textAlign":"center","showMoreOnNewLine":false,"excerptLength":12,"fontSize":"sm"} /-->
<!-- /wp:post-template -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"align":"center","textColor":"ink-soft"} -->
<p class="has-text-align-center has-ink-soft-color has-text-color">Your baskets will show up here automatically. Add your first one under <strong>Baskets → Add New</strong>.</p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query --></div>
<!-- /wp:group -->
