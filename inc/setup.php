<?php
/**
 * Theme Setup.
 *
 * @package Solucion
 */

add_action( 'after_setup_theme', 'solucion_setup', 5 );
add_action( 'after_setup_theme', 'solucion_content_width', 0 );
add_action( 'wp_enqueue_scripts', 'solucion_assets' );
add_action( 'widgets_init', 'solucion_widgets', 5 );
add_action( 'init', 'solucion_image_sizes', 5 );
add_action( 'hybrid_register_layouts', 'solucion_layouts' );
add_filter( 'show_admin_bar' , 'abe_show_admin_bar' );


function abe_show_admin_bar( $content ) {
	return defined( 'WP_DEBUG' ) && WP_DEBUG ? $content : false;
}


/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function solucion_setup() {

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'breadcrumb-trail' );

	add_theme_support( 'get-the-image' );

	add_theme_support( 'hybrid-core-template-hierarchy' );

	add_theme_support( 'theme-layouts', array( 'default' => '1-column' ) );

	add_theme_support( 'customize-selective-refresh-widgets' );

	register_nav_menus(array(
		'primary'   => esc_html__( 'Primary', 'solucion' ),
	));

	add_theme_support('post-formats', array(
		'gallery',
		'link',
		'image',
		'quote',
		'video',
		'audio',
	));

	/*
	 * Enable support for custom logo.
	 *
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 150,
		'width'       => 150,
		'flex-width' => true,
	) );

	// Tell the TinyMCE editor to use a custom stylesheet.
	add_editor_style( solucion_get_editor_styles() );
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function solucion_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'abe_content_width', 1184 );
}

/**
 * Scripts and stylesheets
 */
function solucion_assets() {
	$suffix = hybrid_get_min_suffix();

	// Load parent theme stylesheet if child theme is active.
	if ( is_child_theme() ) {
		wp_enqueue_style( 'hybrid-parent' ); }
	// Load active theme stylesheet.
	wp_enqueue_style( 'hybrid-style' );

	// Scripts.

	// wp_enqueue_script(
	// 'solucion_js',
	// trailingslashit( get_template_directory_uri() )."js/solucion{$suffix}.js",
	// false, false, true
	// );
	wp_enqueue_style( 'oldie', trailingslashit( get_template_directory_uri() )."css/oldie{$suffix}.css", array( 'hybrid-style' ) );
	wp_style_add_data( 'oldie', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'html5shiv', trailingslashit( get_template_directory_uri() ).'js/polyfill/html5shiv.min.js',  false, false, false );
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'classlist', trailingslashit( get_template_directory_uri() ).'js/polyfill/classList.min.js',  false, false, false );
	wp_script_add_data( 'classlist', 'conditional', 'IE' );

	wp_enqueue_script( 'flexibility', trailingslashit( get_template_directory_uri() ).'js/flexibility.js',  false, false, false );
	wp_script_add_data( 'flexibility', 'conditional', 'IE' );
}

/**
 * Styles for the editor.
 */
function solucion_get_editor_styles() {
	/* Set up an array for the styles. */
	$editor_styles = array();

	/* Add the theme's editor styles. */
	$editor_styles[] = trailingslashit( get_template_directory_uri() ) . 'style.css';

	/* If a child theme, add its editor styles. */
	if ( is_child_theme() ) {
		$editor_styles[] = trailingslashit( get_stylesheet_directory_uri() ) . 'style.css'; }

	/* Return the styles. */
	return $editor_styles;
}

/**
 * Registers sidebars.
 *
 * @access public
 * @return void
 */
function solucion_widgets() {
	hybrid_register_sidebar(
		array(
			'id'          => 'primary',
			'name'        => _x( 'Primary', 'sidebar', 'solucion' ),
			'description' => __( 'The main sidebar. It is displayed on either the left or right side of the page based on the chosen layout.', 'solucion' ),
		)
	);
	hybrid_register_sidebar(
		array(
			'id'          => 'footer',
			'name'        => _x( 'Footer', 'sidebar', 'solucion' ),
			'description' => __( 'A sidebar located in the footer of the site.', 'solucion' ),
		)
	);
}

/**
 * Create additional sizes.
 */
function solucion_image_sizes() {
	add_image_size( 'abe-hd', 1200, 675, true );
	add_image_size( 'abe-hd-half', 1200, 338, true );
	add_image_size( 'abe-card-md', 660, 371, true );
	add_image_size( 'abe-card', 330, 186, true );
	add_image_size( 'abe-icon', 80, 80, true );
}

/**
 * Hybrid Theme Layouts
 */
function solucion_layouts() {

	hybrid_register_layout('1-column', array(
		'label'            => _x( 'Single Column', 'theme layout', 'solucion' ),
		'is_global_layout' => true,
		'image'            => '%s/images/single-column.svg',
	));

	hybrid_register_layout('1-column-wide', array(
		'label'            => _x( 'Single Column Wide', 'theme layout', 'solucion' ),
		'is_global_layout' => true,
		'image'            => '%s/images/single-column-wide.svg',
	));

	hybrid_register_layout('sidebar-right', array(
		'label'            => _x( 'Sidebar Right', 'theme layout', 'solucion' ),
		'is_global_layout' => true,
		'image'            => '%s/images/sidebar-right.svg',
	));

	hybrid_register_layout('sidebar-left', array(
		'label'            => _x( 'Sidebar Left', 'theme layout', 'solucion' ),
		'is_global_layout' => true,
		'image'            => '%s/images/sidebar-left.svg',
	));
}
