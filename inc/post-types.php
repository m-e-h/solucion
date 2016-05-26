<?php
/**
 * Post Types.
 *
 * @package  RCDOC
 */

add_action( 'init', 'sol_register_post_types' );

/**
 * Register post_types.
 *
 * @since  0.1.0
 * @access public
 */
function sol_register_post_types() {

	$sol_page_supports = array(
		'title',
		'editor',
		'author',
		'thumbnail',
		'excerpt',
		'page-attributes',
		'theme-layouts',
		'archive',
	);

	register_extended_post_type( 'eng_sol', array(

	    # Add the post type to the site's main RSS feed:
	    'show_in_feed' => true,
		'supports'            => $sol_page_supports,

	), array(

	    # Override the base names used for labels:
	    'singular' => 'Engineering Solutions',
	    'plural'   => 'Engineering Solutions',
	    'slug'     => 'engineering-solutions'

	) );

	register_extended_post_type( 'staff_exec', array(

	    # Add the post type to the site's main RSS feed:
	    'show_in_feed' => true,
		'supports'            => $sol_page_supports,

	), array(

	    # Override the base names used for labels:
	    'singular' => 'Staffing and Executive',
	    'plural'   => 'Staffing and Executive',
	    'slug'     => 'staffing-executive'

	) );
}
