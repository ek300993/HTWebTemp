<?php
/**
 * Happy Turtle — theme functions.
 *
 * Deliberately small. Colours, type, spacing and layout all live in theme.json;
 * page sections live in /patterns. This file only wires up assets, registers the
 * block style variations used by those patterns, and runs a one-time content
 * setup so a fresh install looks like the design straight away.
 *
 * @package HappyTurtle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'HAPPY_TURTLE_VERSION', '1.0.0' );

require_once get_theme_file_path( 'inc/block-styles.php' );
require_once get_theme_file_path( 'inc/setup-content.php' );


/**
 * Theme supports.
 */
function happy_turtle_setup() {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);

	// Makes style.css apply inside the block editor as well as on the front end.
	add_editor_style( 'style.css' );
}
add_action( 'after_setup_theme', 'happy_turtle_setup' );


/**
 * Fonts and stylesheet.
 *
 * `enqueue_block_assets` fires both on the front end and inside the block
 * editor iframe, so what the owner sees while editing matches the live site.
 */
function happy_turtle_assets() {
	wp_enqueue_style(
		'happy-turtle-fonts',
		'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500;1,600&family=Jost:wght@300;400;500;600&family=Parisienne&display=swap',
		array(),
		null // Google serves its own cache headers; a version query string only breaks them.
	);

	wp_enqueue_style(
		'happy-turtle-style',
		get_stylesheet_uri(),
		array( 'happy-turtle-fonts' ),
		HAPPY_TURTLE_VERSION
	);
}
add_action( 'enqueue_block_assets', 'happy_turtle_assets' );


/**
 * Warm up the font connection a little earlier.
 *
 * @param array  $urls          URLs already queued for the given relation.
 * @param string $relation_type The relation type being filtered.
 * @return array
 */
function happy_turtle_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
		$urls[] = array( 'href' => 'https://fonts.googleapis.com' );
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'happy_turtle_resource_hints', 10, 2 );


/**
 * Pattern category.
 *
 * Runs at priority 9 so the category exists before WordPress registers the
 * theme's own patterns on the same hook.
 */
function happy_turtle_pattern_categories() {
	register_block_pattern_category(
		'happy-turtle',
		array(
			'label'       => __( 'Happy Turtle', 'happy-turtle' ),
			'description' => __( 'Ready-made sections for the Happy Turtle site.', 'happy-turtle' ),
		)
	);
}
add_action( 'init', 'happy_turtle_pattern_categories', 9 );


/**
 * Keep words apart in auto-generated excerpts.
 *
 * WordPress builds an excerpt by stripping tags out of the content, so a <br>
 * or a closing </p> sitting between two words leaves them fused together —
 * "Thoughtful Gifts,Made Just for You", "life'sspecial moments". Baskets carry
 * hand-written excerpts, so the visible case is pages pulled into search
 * results, where it reads as broken text.
 *
 * Inserting a space before the tag is enough; strip_tags then leaves the space
 * behind. Only runs while an excerpt is being generated, so page output is
 * untouched.
 *
 * @param string $content Post content.
 * @return string
 */
function happy_turtle_space_out_excerpt_source( $content ) {

	if ( ! doing_filter( 'get_the_excerpt' ) ) {
		return $content;
	}

	return preg_replace( '#<(?:br|/p|/h[1-6]|/li|/blockquote|/figcaption)\s*/?>#i', ' $0', $content );
}
add_filter( 'the_content', 'happy_turtle_space_out_excerpt_source', 5 );


/**
 * Return the raw block markup of one of this theme's patterns.
 *
 * Used by the first-run setup so page content and the pattern inserter stay in
 * sync from a single source — the pattern file itself.
 *
 * @param string $slug Pattern file name without the extension, e.g. 'hero'.
 * @return string Block markup, or an empty string if the pattern is missing.
 */
function happy_turtle_pattern_markup( $slug ) {
	$file = get_theme_file_path( 'patterns/' . $slug . '.php' );

	if ( ! file_exists( $file ) ) {
		return '';
	}

	ob_start();
	include $file;

	return trim( (string) ob_get_clean() );
}
