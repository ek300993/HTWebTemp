<?php
/**
 * Title: About — Nice to Meet You
 * Slug: happy-turtle/about-intro
 * Categories: happy-turtle
 * Description: The founder's introduction — a portrait photograph beside the story of how the studio started.
 * Keywords: about, story, introduction, founder, joyce, maker
 * Viewport Width: 1400
 *
 * Locked to content-only editing, like the other split sections: the words and
 * the photograph are editable, the two-column scaffolding is not.
 *
 * The image is a portrait 4:5 crop and ships as placeholder.svg until a headshot
 * arrives. WordPress strips an <img> with no src altogether, which collapses the
 * column to nothing — so an unfinished slot has to be a real file.
 *
 * @package HappyTurtle
 */

$ht_img = static function ( $file ) {
	return esc_url( get_theme_file_uri( 'assets/images/' . $file ) );
};

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxl","bottom":"var:preset|spacing|xxl"}}},"backgroundColor":"cream","layout":{"type":"constrained"},"templateLock":"contentOnly"} -->
<div class="wp-block-group alignfull has-cream-background-color has-background" style="padding-top:var(--wp--preset--spacing--xxl);padding-bottom:var(--wp--preset--spacing--xxl)"><!-- wp:columns {"verticalAlignment":"top","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|xl","left":"var:preset|spacing|xl"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-top"><!-- wp:column {"verticalAlignment":"top","width":"38%"} -->
<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:38%"><!-- wp:image {"aspectRatio":"4/5","scale":"cover","sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="<?php echo $ht_img( 'placeholder.svg' ); ?>" alt="Joyce, founder of Happy Turtle Custom Gifts" style="aspect-ratio:4/5;object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"top"} -->
<div class="wp-block-column is-vertically-aligned-top"><!-- wp:heading {"fontSize":"xl"} -->
<h2 class="wp-block-heading has-xl-font-size">Nice to Meet You</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-heart-divider","style":{"spacing":{"margin":{"top":"var:preset|spacing|sm","bottom":"var:preset|spacing|md"}}}} -->
<p class="is-style-heart-divider" style="margin-top:var(--wp--preset--spacing--sm);margin-bottom:var(--wp--preset--spacing--md)">♥</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"ink-soft"} -->
<p class="has-ink-soft-color has-text-color">Hello! I'm Joyce, founder and designer behind Happy Turtle Custom Gifts.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"ink-soft"} -->
<p class="has-ink-soft-color has-text-color">My passion for gift curation began when I created personalized graduation baskets for my son and his church youth group friends. Seeing the joy that tailored gifts brought to such a milestone moment inspired me to start Happy Turtle Custom Gifts. Today, I craft custom gift baskets for all of life's special occasions—from welcoming new babies and celebrating new homes to simply sending a thoughtful "thinking of you."</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"ink-soft"} -->
<p class="has-ink-soft-color has-text-color">I believe a truly great gift makes the recipient feel seen, known, and cherished. Every basket is uniquely tailored to reflect the recipient's personality, passions, and story. Beyond creating a memorable presentation, I carefully select practical, high-quality containers and items that can be seamlessly repurposed for everyday life.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"ink-soft"} -->
<p class="has-ink-soft-color has-text-color">I would love to partner with you to create a beautiful, meaningful gift that leaves a lasting impression.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-script","style":{"spacing":{"margin":{"top":"var:preset|spacing|md"}}}} -->
<p class="is-style-script" style="margin-top:var(--wp--preset--spacing--md)">thank you for supporting my small business! ♥</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
