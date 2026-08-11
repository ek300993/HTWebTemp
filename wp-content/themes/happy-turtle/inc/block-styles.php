<?php
/**
 * Block style variations.
 *
 * These are the small typographic flourishes from the design that would
 * otherwise have to be hand-coded into every section. Registering them as block
 * styles means the owner picks them from the Styles tab in the sidebar instead.
 *
 * The CSS for each lives in style.css.
 *
 * @package HappyTurtle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the variations.
 */
function happy_turtle_block_styles() {

	// The "— ♥ —" rule that sits under section headings.
	register_block_style(
		'core/paragraph',
		array(
			'name'  => 'heart-divider',
			'label' => __( 'Heart Divider', 'happy-turtle' ),
		)
	);

	// Handwritten script, e.g. "thank you for supporting my small business!"
	foreach ( array( 'core/paragraph', 'core/heading' ) as $block ) {
		register_block_style(
			$block,
			array(
				'name'  => 'script',
				'label' => __( 'Handwritten', 'happy-turtle' ),
			)
		);
	}

	// Small spaced-out label above a heading, e.g. "HANDMADE & CUSTOM".
	register_block_style(
		'core/paragraph',
		array(
			'name'  => 'eyebrow',
			'label' => __( 'Eyebrow Label', 'happy-turtle' ),
		)
	);

	// Bullet-free list, used for the footer link columns.
	register_block_style(
		'core/list',
		array(
			'name'  => 'plain',
			'label' => __( 'Plain (no bullets)', 'happy-turtle' ),
		)
	);
}
add_action( 'init', 'happy_turtle_block_styles' );
