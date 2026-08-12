<?php
/**
 * First-run content setup.
 *
 * Activating the theme once creates the pages the design implies, fills the
 * homepage with the section patterns, and points WordPress at it. Without this
 * step a fresh install shows a blank "Sample Page" and the owner has to assemble
 * the homepage by hand, which is exactly the part we want them not to do.
 *
 * Guarded by an option, so it runs once and never re-creates or overwrites
 * anything the owner has since edited.
 *
 * @package HappyTurtle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Pages to create, in menu order.
 *
 * The order here is the order of the menu. The header's Navigation block has no
 * saved menu of its own, so it falls back to a Page List — which lists published
 * pages by menu_order, and menu_order is set from this array. Reordering these
 * entries on a fresh install reorders the menu; on a site that has already been
 * set up, the owner reorders pages under Pages → Quick Edit → Order.
 *
 * A note on templates. 'page-no-title' suppresses the title banner, so it is
 * only used where the page's own content already supplies an <h1> — the hero on
 * the homepage, the heading in the contact pattern. The other pages use the
 * default template and take their <h1> from the page title, which keeps the
 * document outline correct for screen readers and search engines.
 *
 * @return array
 */
function happy_turtle_starter_pages() {
	return array(
		array(
			'slug'     => 'home',
			'title'    => __( 'Home', 'happy-turtle' ),
			'patterns' => array( 'hero', 'value-props', 'occasion-grid', 'about-split', 'cta-banner' ),
			'template' => 'page-no-title', // Hero supplies the <h1>.
		),
		array(
			'slug'     => 'about',
			'title'    => __( 'About', 'happy-turtle' ),
			'patterns' => array( 'about-intro', 'about-personal', 'cta-banner' ),
			'template' => '',
		),
		array(
			'slug'     => 'browse-baskets',
			'title'    => __( 'Browse Baskets', 'happy-turtle' ),
			'patterns' => array( 'page-browse-baskets', 'cta-banner' ),
			'template' => '',
		),
		array(
			'slug'     => 'how-it-works',
			'title'    => __( 'How It Works', 'happy-turtle' ),
			'patterns' => array( 'how-it-works', 'cta-banner' ),
			'template' => '',
		),
		array(
			'slug'     => 'gallery',
			'title'    => __( 'Gallery', 'happy-turtle' ),
			'patterns' => array( 'gallery-intro', 'featured-baskets', 'gallery-baskets', 'gallery-items', 'cta-banner' ),
			'template' => '',
		),
		array(
			'slug'     => 'reviews',
			'title'    => __( 'Reviews', 'happy-turtle' ),
			'patterns' => array( 'reviews', 'cta-banner' ),
			'template' => '',
		),
		array(
			'slug'     => 'contact',
			'title'    => __( 'Contact', 'happy-turtle' ),
			'patterns' => array( 'page-contact' ),
			'template' => 'page-no-title', // Contact pattern supplies the <h1>.
		),
	);
}

/**
 * Create the starter pages and set the front page. Runs once per site.
 */
function happy_turtle_first_run() {

	if ( get_option( 'happy_turtle_setup_complete' ) ) {
		return;
	}

	$created = array();
	$order   = 0;

	foreach ( happy_turtle_starter_pages() as $page ) {

		// Never clobber a page the owner already made at this slug.
		$existing = get_page_by_path( $page['slug'] );
		if ( $existing instanceof WP_Post ) {
			$created[ $page['slug'] ] = $existing->ID;
			continue;
		}

		$content = '';
		foreach ( $page['patterns'] as $pattern ) {
			$markup = happy_turtle_pattern_markup( $pattern );
			if ( '' !== $markup ) {
				$content .= $markup . "\n\n";
			}
		}

		$page_id = wp_insert_post(
			array(
				'post_title'   => $page['title'],
				'post_name'    => $page['slug'],
				'post_content' => trim( $content ),
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'menu_order'   => ++$order,
			)
		);

		if ( is_wp_error( $page_id ) || ! $page_id ) {
			continue;
		}

		if ( ! empty( $page['template'] ) ) {
			update_post_meta( $page_id, '_wp_page_template', $page['template'] );
		}

		$created[ $page['slug'] ] = $page_id;
	}

	// Point the site at the new homepage.
	if ( ! empty( $created['home'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $created['home'] );
	}

	// Tidy up the default WordPress sample page if it is still untouched.
	$sample = get_page_by_path( 'sample-page' );
	if ( $sample instanceof WP_Post && 'publish' === $sample->post_status ) {
		wp_trash_post( $sample->ID );
	}

	update_option( 'happy_turtle_setup_complete', HAPPY_TURTLE_VERSION );
}
add_action( 'after_switch_theme', 'happy_turtle_first_run' );
