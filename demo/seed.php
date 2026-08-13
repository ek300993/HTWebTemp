<?php
/**
 * Demo seed for the WordPress Playground preview.
 *
 * The theme's own first-run routine already builds the pages on activation, so
 * this only adds what a fresh install can't invent: the logo and a catalogue of
 * baskets with photographs.
 *
 * Everything is sideloaded from files already inside the theme, so the demo
 * needs no network access and can't half-load.
 *
 * NOT part of the theme or plugin — this file exists purely to make the shared
 * preview link show a populated site.
 *
 * @package HappyTurtleDemo
 */

require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

/**
 * Copy an image out of the theme into the media library.
 *
 * @param string $file  Filename inside the theme's assets/images directory.
 * @param string $title Attachment title.
 * @return int Attachment ID, or 0 on failure.
 */
function htdemo_attach( $file, $title ) {

	$src = get_theme_file_path( 'assets/images/' . $file );
	if ( ! file_exists( $src ) ) {
		return 0;
	}

	$uploads = wp_upload_dir();
	$dest    = trailingslashit( $uploads['path'] ) . $file;

	if ( ! copy( $src, $dest ) ) {
		return 0;
	}

	$id = wp_insert_attachment(
		array(
			'post_mime_type' => 'image/' . ( 'png' === pathinfo( $file, PATHINFO_EXTENSION ) ? 'png' : 'jpeg' ),
			'post_title'     => $title,
			'post_status'    => 'inherit',
		),
		$dest
	);

	if ( is_wp_error( $id ) || ! $id ) {
		return 0;
	}

	wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $dest ) );
	update_post_meta( $id, '_wp_attachment_image_alt', $title );

	return (int) $id;
}

// --- Logo -----------------------------------------------------------------
$logo = htdemo_attach( 'logo.png', 'Happy Turtle Custom Gifts' );
if ( $logo ) {
	set_theme_mod( 'custom_logo', $logo );
	update_option( 'site_logo', $logo );
}

// --- Baskets --------------------------------------------------------------
$baskets = array(
	array(
		'title'    => 'Welcome Baby Basket',
		'slug'     => 'welcome-baby-basket',
		'excerpt'  => 'For the whole new family',
		'occasion' => 'new-baby',
		'image'    => 'new-baby-letterboard.jpg',
		'intro'    => 'A basket for the announcement moment — something for the baby, something for the parents, and a personalised letterboard for the photo everyone ends up taking.',
		'items'    => array( 'Personalised letterboard with the arrival details', 'Knitted blanket', 'Plush giraffe and elephant', 'Bodysuit and bib set', 'Hooded towel' ),
	),
	array(
		'title'    => 'Personalised New Baby Basket',
		'slug'     => 'personalised-new-baby-basket',
		'excerpt'  => 'Named, and made to keep',
		'occasion' => 'new-baby',
		'image'    => 'new-baby-elephant.jpg',
		'intro'    => "Built inside a rope basket with the baby's name appliqued on the front, so the basket itself becomes the keepsake long after the contents are used up.",
		'items'    => array( 'Rope storage basket with appliqued name', 'Plush blanket', 'Personalised bib and swaddle', 'Wooden name hangers', 'Treats for the parents' ),
	),
	array(
		'title'    => 'Housewarming Basket',
		'slug'     => 'housewarming-basket',
		'excerpt'  => 'For a brand new front door',
		'occasion' => 'new-home',
		'image'    => 'new-home-welcome.jpg',
		'intro'    => 'Everything that makes a new place feel lived in on the first night, with a few things from around the neighbourhood so it feels like a proper welcome.',
		'items'    => array( 'Fringed throw blanket', 'Champagne and chocolate bark', 'Local tote and neighbourhood guide', 'Potted succulent', 'Personalised letterboard' ),
	),
	array(
		'title'    => 'Graduation Crate',
		'slug'     => 'graduation-crate',
		'excerpt'  => 'Off to be amazing',
		'occasion' => 'graduation',
		'image'    => 'graduation-crate.jpg',
		'intro'    => 'A wooden crate rather than a basket, so it stands up on a desk in a dorm room. Personalised tumbler, a few practical things, and a letterboard for the photos.',
		'items'    => array( 'Personalised insulated tumbler', 'Congrats Grad letterboard', 'Handmade zip pouch', 'Journal and pens', 'Chocolate treats' ),
	),
	array(
		'title'    => 'Class of 2026 Basket',
		'slug'     => 'class-of-2026-basket',
		'excerpt'  => 'The tassel was worth the hassle',
		'occasion' => 'graduation',
		'image'    => 'graduation-class-2026.jpg',
		'intro'    => 'A softer take on the graduation basket — a Class of 2026 bear, a personalised rope basket, and a letterboard ready for the photo.',
		'items'    => array( 'Class of 2026 embroidered bear', 'Personalised rope basket', 'Journal with keepsake ribbon', 'Celebration letterboard', 'Chocolate treats' ),
	),
);

foreach ( $baskets as $b ) {

	if ( get_page_by_path( $b['slug'], OBJECT, 'basket' ) ) {
		continue;
	}

	$list = '';
	foreach ( $b['items'] as $item ) {
		$list .= '<li>' . $item . '</li>';
	}

	$content = '<!-- wp:paragraph --><p>' . $b['intro'] . '</p><!-- /wp:paragraph -->'
		. '<!-- wp:heading {"fontSize":"lg"} --><h2 class="wp-block-heading has-lg-font-size">What Went Inside</h2><!-- /wp:heading -->'
		. '<!-- wp:list --><ul class="wp-block-list">' . $list . '</ul><!-- /wp:list -->';

	$id = wp_insert_post(
		array(
			'post_type'    => 'basket',
			'post_status'  => 'publish',
			'post_title'   => $b['title'],
			'post_name'    => $b['slug'],
			'post_excerpt' => $b['excerpt'],
			'post_content' => $content,
		)
	);

	if ( is_wp_error( $id ) || ! $id ) {
		continue;
	}

	wp_set_object_terms( $id, $b['occasion'], 'basket_occasion' );

	$att = htdemo_attach( $b['image'], $b['title'] );
	if ( $att ) {
		set_post_thumbnail( $id, $att );
	}
}

// --- Site settings --------------------------------------------------------
update_option( 'blogname', 'Happy Turtle Custom Gifts' );
update_option( 'blogdescription', 'Beautifully curated gift baskets' );
update_option( 'permalink_structure', '/%postname%/' );

$home = get_page_by_path( 'home' );
if ( $home ) {
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $home->ID );
}

flush_rewrite_rules();

echo "seeded\n";
