<?php
/**
 * Title: About — Personal Life
 * Slug: happy-turtle/about-personal
 * Categories: happy-turtle
 * Description: The second About section — life outside the studio, with a photograph alongside.
 * Keywords: about, personal, family, teaching, hobbies
 * Viewport Width: 1400
 *
 * The mirror image of about-intro: text on the left, photograph on the right, so
 * the two sections don't read as one long column. Locked to content-only editing
 * for the same reason as the others.
 *
 * @package HappyTurtle
 */

$ht_img = static function ( $file ) {
	return esc_url( get_theme_file_uri( 'assets/images/' . $file ) );
};

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxl","bottom":"var:preset|spacing|xxl"}}},"backgroundColor":"sage-mist","layout":{"type":"constrained"},"templateLock":"contentOnly"} -->
<div class="wp-block-group alignfull has-sage-mist-background-color has-background" style="padding-top:var(--wp--preset--spacing--xxl);padding-bottom:var(--wp--preset--spacing--xxl)"><!-- wp:columns {"verticalAlignment":"top","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|xl","left":"var:preset|spacing|xl"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-top"><!-- wp:column {"verticalAlignment":"top"} -->
<div class="wp-block-column is-vertically-aligned-top"><!-- wp:paragraph {"className":"is-style-eyebrow"} -->
<p class="is-style-eyebrow">About Me</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"fontSize":"xl"} -->
<h2 class="wp-block-heading has-xl-font-size">Personal Life</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"is-style-heart-divider","style":{"spacing":{"margin":{"top":"var:preset|spacing|sm","bottom":"var:preset|spacing|md"}}}} -->
<p class="is-style-heart-divider" style="margin-top:var(--wp--preset--spacing--sm);margin-bottom:var(--wp--preset--spacing--md)">♥</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"ink-soft"} -->
<p class="has-ink-soft-color has-text-color">Born and raised in Taiwan, I am fluent in both Mandarin and English and proud of my Taiwanese-American heritage. Today, I call Burlington, MA home, where I live with my husband, Jeff, our three children, and our Black Lab, Zuzu.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"ink-soft"} -->
<p class="has-ink-soft-color has-text-color">By day, I'm a high school mathematics teacher at Weston High School—a role I've loved for over 12 years—alongside my work with private tutoring and Harvard's Crimson Summer Academy. I'm a self-proclaimed math nerd at heart who loves solving complex puzzles and exploring how math connects to the world around us, from fractals and trigonometry to cryptography.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"ink-soft"} -->
<p class="has-ink-soft-color has-text-color">My love for patterns and details extends naturally into my creative life. I've been an avid scrapbooker for decades, capturing sweet everyday moments with my family, and my years of crafting (and mastering my Cricut machine!) seamlessly inspired the start of Happy Turtle Custom Gifts.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"ink-soft"} -->
<p class="has-ink-soft-color has-text-color">Outside of teaching and designing, my Christian faith is a foundational part of who I am, and I find deep fulfillment in serving at my church. In my free time, you can usually find me playing pickleball, walking Zuzu, diving into a good book, or happily organizing—which is truly a hobby in itself!</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"top","width":"38%"} -->
<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:38%"><!-- wp:image {"aspectRatio":"4/5","scale":"cover","sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="<?php echo $ht_img( 'placeholder.svg' ); ?>" alt="Joyce away from the studio" style="aspect-ratio:4/5;object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
