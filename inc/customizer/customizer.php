<?php
/**
 * Theme Customizer.
 *
 * @package Solucion
 */

add_action( 'customize_register', 'solucion_customize_register', 11 );
add_action( 'customize_preview_init', 'solucion_customizer_js' );
// add_action( 'wp_enqueue_scripts', 'solucion_google_fonts' );
//add_action( 'customize_register', 'my_register_blogname_partials' );

/**
 * Customizer Settings
 *
 * @param  array $wp_customize Add controls and settings.
 */
function solucion_customize_register( $wp_customize ) {

	// Customize title and tagline sections and labels.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {

	    $wp_customize->selective_refresh->add_partial( 'blogname', array(
	        'selector' => '#site-title a',
	        'render_callback' => function() {
	            return get_bloginfo( 'name', 'display' );
	        },
	    ) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
	        'selector' => '#site-description',
	        'render_callback' => function() {
	            return get_bloginfo( 'description', 'display' );
	        },
	    ) );
	}

	// Theme layouts.
	$wp_customize->get_setting( 'theme_layout' )->transport = 'refresh';

	// Add the primary color setting.
	$wp_customize->add_setting(
		'primary_color',
		array(
			'default'              => apply_filters( 'theme_mod_primary_color', '' ),
			'type'                 => 'theme_mod',
			'sanitize_callback'    => 'sanitize_hex_color_no_hash',
			'sanitize_js_callback' => 'maybe_hash_hex_color',
			// 'transport'            => 'postMessage',
		)
	);

	// Add secondary color control.
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'custom-primary-color',
			array(
				'label'    => esc_html__( 'Primary Color', 'solucion' ),
				'section'  => 'colors',
				'settings' => 'primary_color',
				'priority' => 10,
			)
		)
	);

	// Add the secondary color setting.
	$wp_customize->add_setting(
		'secondary_color',
		array(
			'default'              => apply_filters( 'theme_mod_secondary_color', '' ),
			'type'                 => 'theme_mod',
			'sanitize_callback'    => 'sanitize_hex_color_no_hash',
			'sanitize_js_callback' => 'maybe_hash_hex_color',
			// 'transport'            => 'postMessage',
		)
	);

	/* Add the primary color control. */
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'custom-secondary-color',
			array(
				'label'    => esc_html__( 'Secondary Color', 'solucion' ),
				'section'  => 'colors',
				'settings' => 'secondary_color',
				'priority' => 15,
			)
		)
	);

	/* Typography. */
	// $wp_customize->add_section(
	// 	'custom_typography',
	// 	array(
	// 	'title'    => esc_html__( 'Typography', 'solucion' ),
	// 	'priority' => 80,
	// 	)
	// );

	/* Adds the heading font setting. */
	// $wp_customize->add_setting(
	// 	'heading_font',
	// 	array(
	// 		'default'              => 'Georgia,Times,"Times New Roman",serif',
	// 		'type'                 => 'theme_mod',
	// 		'sanitize_callback'    => 'sanitize_text_field',
	// 		// 'transport'            => 'postMessage',
	// 	)
	// );
	/* Adds the heading font control. */
	// $wp_customize->add_control(
	// 	'solucion-heading-font',
	// 	array(
	// 		'label'    => esc_html__( 'Heading Font', 'solucion' ),
	// 		'section'  => 'custom_typography',
	// 		'settings' => 'heading_font',
	// 		'type'     => 'select',
	// 		'choices'  => customizer_library_get_font_choices(),
	// 	)
	// );

	/* Adds the body font setting. */
	// $wp_customize->add_setting(
	// 	'body_font',
	// 	array(
	// 		'default'              => '-apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Helvetica Neue",Arial,sans-serif',
	// 		'type'                 => 'theme_mod',
	// 		'sanitize_callback'    => 'sanitize_text_field',
	// 		// 'transport'            => 'postMessage',
	// 	)
	// );
	/* Adds the body font control. */
	// $wp_customize->add_control(
	// 	'solucion-body-font',
	// 	array(
	// 		'label'    => esc_html__( 'Body Font', 'solucion' ),
	// 		'section'  => 'custom_typography',
	// 		'settings' => 'body_font',
	// 		'type'     => 'select',
	// 		'choices'  => customizer_library_get_font_choices(),
	// 	)
	// );
}

/**
 * Custom js for theme customizer
 */
function solucion_customizer_js() {

	/* Use the .min script if SCRIPT_DEBUG is turned off. */
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_script(
		'solucion_theme_customizer',
		trailingslashit( get_template_directory_uri() ) . "js/customizer{$suffix}.js",
		array( 'customize-preview' ),
		null,
		true
	);
}

/**
 * Enqueue Google Fonts.
 */
function solucion_google_fonts() {
	$fonts = array(
		get_theme_mod( 'heading_font', 'default' ),
		get_theme_mod( 'body_font', 'default' ),
	);
	$font_uri = customizer_library_get_google_font_uri( $fonts );

	wp_enqueue_style( 'google_font_headings', $font_uri, array(), null, 'screen' );
}
