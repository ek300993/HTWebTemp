<?php
/**
 * Plugin Name:       Happy Turtle Gift Baskets
 * Description:       Adds the gift basket catalogue — a Baskets post type and Occasions taxonomy — and the enquiry form on the Contact page. Lives in a plugin rather than the theme on purpose: if the site is ever re-themed, the baskets stay put.
 * Version:           1.2.0
 * Requires at least: 6.6
 * Requires PHP:      7.4
 * Author:            Happy Turtle Custom Gifts
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       happy-turtle-gifts
 *
 * @package HappyTurtleGifts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'HAPPY_TURTLE_GIFTS_VERSION', '1.2.0' );

require_once plugin_dir_path( __FILE__ ) . 'inc/contact-form.php';


/**
 * Register the Baskets post type.
 *
 * `show_in_rest` is what makes it use the block editor rather than the old
 * classic one — without it the owner gets a completely different writing
 * experience on baskets than on pages.
 */
function happy_turtle_register_basket_post_type() {

	$labels = array(
		'name'                  => _x( 'Gift Baskets', 'Post type general name', 'happy-turtle-gifts' ),
		'singular_name'         => _x( 'Gift Basket', 'Post type singular name', 'happy-turtle-gifts' ),
		'menu_name'             => _x( 'Baskets', 'Admin Menu text', 'happy-turtle-gifts' ),
		'add_new'               => __( 'Add New', 'happy-turtle-gifts' ),
		'add_new_item'          => __( 'Add New Basket', 'happy-turtle-gifts' ),
		'edit_item'             => __( 'Edit Basket', 'happy-turtle-gifts' ),
		'new_item'              => __( 'New Basket', 'happy-turtle-gifts' ),
		'view_item'             => __( 'View Basket', 'happy-turtle-gifts' ),
		'view_items'            => __( 'View Baskets', 'happy-turtle-gifts' ),
		'search_items'          => __( 'Search Baskets', 'happy-turtle-gifts' ),
		'not_found'             => __( 'No baskets yet — add your first one.', 'happy-turtle-gifts' ),
		'not_found_in_trash'    => __( 'No baskets in the bin.', 'happy-turtle-gifts' ),
		'all_items'             => __( 'All Baskets', 'happy-turtle-gifts' ),
		'featured_image'        => __( 'Basket Photo', 'happy-turtle-gifts' ),
		'set_featured_image'    => __( 'Set basket photo', 'happy-turtle-gifts' ),
		'remove_featured_image' => __( 'Remove basket photo', 'happy-turtle-gifts' ),
		'use_featured_image'    => __( 'Use as basket photo', 'happy-turtle-gifts' ),
		'item_published'        => __( 'Basket published.', 'happy-turtle-gifts' ),
		'item_updated'          => __( 'Basket updated.', 'happy-turtle-gifts' ),
	);

	register_post_type(
		'basket',
		array(
			'labels'        => $labels,
			'public'        => true,
			'show_in_rest'  => true,
			'menu_icon'     => 'dashicons-heart',
			'menu_position' => 20,
			'has_archive'   => 'shop',
			'rewrite'       => array(
				'slug'       => 'baskets',
				'with_front' => false,
			),
			'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'page-attributes' ),
			'taxonomies'    => array( 'basket_occasion' ),

			/*
			 * A starting skeleton in the editor. Baskets are a portfolio of past
			 * work rather than a fixed product list — every order is custom — so
			 * the headings are worded as a record of what went into one, with
			 * prices shown as a guide. Not locked: blocks can be added or removed.
			 */
			'template'      => array(
				array(
					'core/paragraph',
					array(
						'placeholder' => __( 'A sentence or two about this basket — who it was for and the feeling you wanted it to give.', 'happy-turtle-gifts' ),
					),
				),
				array(
					'core/heading',
					array(
						'level'       => 2,
						'content'     => __( "What Went Inside", 'happy-turtle-gifts' ),
						'fontSize'    => 'lg',
					),
				),
				array(
					'core/list',
					array(
						'placeholder' => __( 'List what went into this one', 'happy-turtle-gifts' ),
					),
					array(
						array( 'core/list-item', array( 'placeholder' => __( 'First item…', 'happy-turtle-gifts' ) ) ),
					),
				),
				array(
					'core/heading',
					array(
						'level'    => 2,
						'content'  => __( 'Size &amp; Price Guide', 'happy-turtle-gifts' ),
						'fontSize' => 'lg',
					),
				),
				array(
					'core/list',
					array(),
					array(
						array( 'core/list-item', array( 'placeholder' => __( 'Small — from £00', 'happy-turtle-gifts' ) ) ),
					),
				),
			),
		)
	);
}
add_action( 'init', 'happy_turtle_register_basket_post_type' );


/**
 * Register the Occasions taxonomy.
 */
function happy_turtle_register_basket_taxonomy() {

	$labels = array(
		'name'              => _x( 'Occasions', 'taxonomy general name', 'happy-turtle-gifts' ),
		'singular_name'     => _x( 'Occasion', 'taxonomy singular name', 'happy-turtle-gifts' ),
		'menu_name'         => __( 'Occasions', 'happy-turtle-gifts' ),
		'all_items'         => __( 'All Occasions', 'happy-turtle-gifts' ),
		'edit_item'         => __( 'Edit Occasion', 'happy-turtle-gifts' ),
		'add_new_item'      => __( 'Add New Occasion', 'happy-turtle-gifts' ),
		'new_item_name'     => __( 'New Occasion Name', 'happy-turtle-gifts' ),
		'search_items'      => __( 'Search Occasions', 'happy-turtle-gifts' ),
		'parent_item'       => __( 'Parent Occasion', 'happy-turtle-gifts' ),
		'parent_item_colon' => __( 'Parent Occasion:', 'happy-turtle-gifts' ),
	);

	register_taxonomy(
		'basket_occasion',
		array( 'basket' ),
		array(
			'labels'            => $labels,
			'public'            => true,
			'hierarchical'      => true,
			'show_in_rest'      => true,
			'show_admin_column' => true,
			'rewrite'           => array(
				'slug'       => 'occasion',
				'with_front' => false,
			),
		)
	);
}
add_action( 'init', 'happy_turtle_register_basket_taxonomy' );


/**
 * The eight kinds of basket the studio makes.
 *
 * The slugs here must match the anchors in the page-browse-baskets pattern, and
 * the order is the order the rows appear on that page.
 *
 * @return array<string,string> slug => name
 */
function happy_turtle_default_occasions() {
	return array(
		'new-baby'        => __( 'New Baby', 'happy-turtle-gifts' ),
		'new-home'        => __( 'New Home', 'happy-turtle-gifts' ),
		'graduation'      => __( 'Graduation', 'happy-turtle-gifts' ),
		'weddings'        => __( 'Weddings', 'happy-turtle-gifts' ),
		'retirement'      => __( 'Retirement', 'happy-turtle-gifts' ),
		'birthday'        => __( 'Birthday', 'happy-turtle-gifts' ),
		'for-teachers'    => __( 'For Teachers', 'happy-turtle-gifts' ),
		'thinking-of-you' => __( 'Thinking of You', 'happy-turtle-gifts' ),
	);
}


/**
 * On activation: register everything, seed the occasions, flush permalinks.
 *
 * Flushing is necessary here because the basket and occasion URLs do not exist
 * in the rewrite rules until the post type has been registered at least once.
 */
function happy_turtle_gifts_activate() {

	happy_turtle_register_basket_post_type();
	happy_turtle_register_basket_taxonomy();

	/*
	 * "Thank You" became "Thinking of You" when the eight kinds of basket were
	 * settled. Rename rather than add, so any basket already filed under it
	 * keeps its occasion instead of quietly ending up in a term nothing links to.
	 */
	$thank_you = term_exists( 'thank-you', 'basket_occasion' );
	if ( $thank_you && ! term_exists( 'thinking-of-you', 'basket_occasion' ) ) {
		wp_update_term(
			(int) $thank_you['term_id'],
			'basket_occasion',
			array(
				'name' => __( 'Thinking of You', 'happy-turtle-gifts' ),
				'slug' => 'thinking-of-you',
			)
		);
	}

	foreach ( happy_turtle_default_occasions() as $slug => $name ) {
		if ( ! term_exists( $slug, 'basket_occasion' ) ) {
			wp_insert_term( $name, 'basket_occasion', array( 'slug' => $slug ) );
		}
	}

	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'happy_turtle_gifts_activate' );


/**
 * On deactivation: clear the rewrite rules we added.
 *
 * Baskets and occasions are left in the database untouched — deactivating a
 * plugin should never delete someone's content.
 */
function happy_turtle_gifts_deactivate() {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'happy_turtle_gifts_deactivate' );


/**
 * Let baskets turn up in site search alongside pages and posts.
 *
 * @param WP_Query $query The query being run.
 */
function happy_turtle_include_baskets_in_search( $query ) {

	if ( is_admin() || ! $query->is_main_query() || ! $query->is_search() ) {
		return;
	}

	$query->set( 'post_type', array( 'post', 'page', 'basket' ) );
}
add_action( 'pre_get_posts', 'happy_turtle_include_baskets_in_search' );


/**
 * Keep the basket you are already looking at out of "You might also like".
 *
 * The Query Loop block has no dynamic "exclude current post" option, so without
 * this a basket can recommend itself. It only shows up once the newest baskets
 * are the ones being viewed, which makes it easy to miss in testing.
 *
 * @param array    $query Query vars the block is about to run.
 * @param WP_Block $block The block instance.
 * @param int      $page  Current page number.
 * @return array
 */
function happy_turtle_exclude_current_basket( $query, $block, $page ) {

	if ( ! is_singular( 'basket' ) ) {
		return $query;
	}

	$post_type = $query['post_type'] ?? '';
	if ( 'basket' !== $post_type && ! ( is_array( $post_type ) && in_array( 'basket', $post_type, true ) ) ) {
		return $query;
	}

	$current = get_the_ID();
	if ( $current ) {
		$query['post__not_in'] = array_merge( $query['post__not_in'] ?? array(), array( $current ) );
	}

	return $query;
}
add_filter( 'query_loop_block_query_vars', 'happy_turtle_exclude_current_basket', 10, 3 );


/**
 * Add a "Photo" column to the Baskets list screen.
 *
 * A basket with no featured image leaves a blank tile in every grid on the
 * site, and it is the easiest thing in the world to forget. This makes the gap
 * visible at a glance instead of only on the live page.
 *
 * @param array $columns Existing admin columns.
 * @return array
 */
function happy_turtle_basket_columns( $columns ) {

	$updated = array();

	foreach ( $columns as $key => $label ) {
		if ( 'title' === $key ) {
			$updated['basket_photo'] = __( 'Photo', 'happy-turtle-gifts' );
		}
		$updated[ $key ] = $label;
	}

	return $updated;
}
add_filter( 'manage_basket_posts_columns', 'happy_turtle_basket_columns' );


/**
 * Render the Photo column.
 *
 * @param string $column  Column key being rendered.
 * @param int    $post_id Post being rendered.
 */
function happy_turtle_basket_column_content( $column, $post_id ) {

	if ( 'basket_photo' !== $column ) {
		return;
	}

	if ( has_post_thumbnail( $post_id ) ) {
		echo get_the_post_thumbnail( $post_id, array( 48, 48 ), array( 'style' => 'border-radius:3px;object-fit:cover;' ) );
		return;
	}

	echo '<span aria-hidden="true" style="display:inline-block;width:48px;height:48px;border-radius:3px;background:#f0f0f1;"></span>';
	echo '<span class="screen-reader-text">' . esc_html__( 'No photo set', 'happy-turtle-gifts' ) . '</span>';
}
add_action( 'manage_basket_posts_custom_column', 'happy_turtle_basket_column_content', 10, 2 );
