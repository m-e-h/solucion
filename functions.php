<?php
/**
 * Theme includes.
 *
 * @package Solucion
 */

$abe_lib = trailingslashit( get_template_directory() ) . 'lib/';
$abe_inc = trailingslashit( get_template_directory() ) . 'inc/';

// 3rd party libraries.
require_once $abe_lib . 'hybrid-core/hybrid.php'; 	// Hybrid Core library.
require_once $abe_lib . 'cmb2/init.php';          	// Custom Metaboxes.
require_once $abe_lib . 'extended-cpts.php';      	// CPT creation library.
require_once $abe_lib . 'extended-taxos.php';     	// Taxonomy creation library.
require_once $abe_lib . 'tha-theme-hooks.php';    	// Template hooks.

// Theme specific includes.
require_once $abe_inc . 'setup.php';                    	// Initial theme setup.
require_once $abe_inc . 'post-types.php';
require_once $abe_inc . 'customizer/Color.php';				// Customizer.
require_once $abe_inc . 'customizer/custom-styles.php';		// Customizer.
require_once $abe_inc . 'customizer/customizer.php';    	// Customizer.
require_once $abe_inc . 'customizer/custom-background.php'; // Customizer.
require_once $abe_inc . 'template-tweaks.php';
require_once $abe_inc . 'template-tags.php';
require_once $abe_inc . 'metaboxes.php';
require_once $abe_inc . 'attr-trumps.php';              // Css class selectors.
require_once $abe_inc . 'utils.php';                    // Utility functions.
require_once $abe_inc . 'tiny-mce.php';                 // Extra wysiwyg actions.

define( 'HYBRID_DIR', trailingslashit( get_template_directory() ) . 'lib/hybrid-core/' );
define( 'HYBRID_URI', trailingslashit( get_template_directory_uri() ) . 'lib/hybrid-core/' );

new Hybrid();

add_filter( 'arch_add_post_types', 'solucion_arch_cpts' );

function solucion_arch_cpts() {
	$cpts = array( 'eng_sol', 'staff_exec' );
	return $cpts;
}
