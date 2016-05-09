<?php
/**
 * Solucion Theme Customizer.
 *
 * @package Solucion
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function meh_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Add our social link options.
    $wp_customize->add_section(
        'meh_social_links_section',
        array(
            'title'       => esc_html__( 'Social Links', 'solucion' ),
            'description' => esc_html__( 'These are the settings for social links. Please limit the number of social links to 5.', 'solucion' ),
            'priority'    => 90,
        )
    );

    // Create an array of our social links for ease of setup.
    $social_networks = array( 'twitter', 'facebook', 'instagram' );

    // Loop through our networks to setup our fields.
    foreach( $social_networks as $network ) {

	    $wp_customize->add_setting(
	        'meh_' . $network . '_link',
	        array(
	            'default' => '',
	            'sanitize_callback' => 'meh_sanitize_customizer_url'
	        )
	    );
	    $wp_customize->add_control(
	        'meh_' . $network . '_link',
	        array(
	            'label'   => sprintf( esc_html__( '%s Link', 'solucion' ), ucwords( $network ) ),
	            'section' => 'meh_social_links_section',
	            'type'    => 'text',
	        )
	    );
    }

    // Add our Footer Customization section section.
    $wp_customize->add_section(
        'meh_footer_section',
        array(
            'title'    => esc_html__( 'Footer Customization', 'solucion' ),
            'priority' => 90,
        )
    );

    // Add our copyright text field.
    $wp_customize->add_setting(
        'meh_copyright_text',
        array(
            'default' => ''
        )
    );
    $wp_customize->add_control(
        'meh_copyright_text',
        array(
            'label'       => esc_html__( 'Copyright Text', 'solucion' ),
            'description' => esc_html__( 'The copyright text will be displayed beneath the menu in the footer.', 'solucion' ),
            'section'     => 'meh_footer_section',
            'type'        => 'text',
            'sanitize'    => 'html'
        )
    );
}
add_action( 'customize_register', 'meh_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function meh_customize_preview_js() {
    wp_enqueue_script( 'meh_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'meh_customize_preview_js' );

/**
 * Sanitize our customizer text inputs.
 */
function meh_sanitize_customizer_text( $input ) {
    return sanitize_text_field( force_balance_tags( $input ) );
}

/**
 * Sanitize our customizer URL inputs.
 */
function meh_sanitize_customizer_url( $input ) {
    return esc_url( $input );
}
