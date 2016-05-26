<?php
/**
 * Modifications to TinyMCE, the default WordPress editor.
 *
 * @package Solucion
 */

add_filter( 'mce_buttons', 'solucion_add_styleselect', 99 );

/**
 * Add styleselect button to the end of the first row of TinyMCE buttons.
 *
 * @since  1.4.0
 *
 * @param  $buttons array existing TinyMCE buttons
 *
 * @return $buttons array modified TinyMCE buttons
 */
function solucion_add_styleselect( $buttons ) {
	// Get rid of styleselect if it's been added somewhere else.
	if ( in_array( 'styleselect', $buttons ) ) {
		unset( $buttons['styleselect'] );
	}
	array_push( $buttons, 'styleselect' );

	return $buttons;
}

add_filter( 'mce_buttons_2', 'solucion_disable_styleselect', 99 );

/**
 * Remove styleselect button if it's been added to the second row of TinyMCE
 * buttons.
 *
 * @since  1.4.0
 *
 * @param  $buttons array existing TinyMCE buttons
 *
 * @return $buttons array modified TinyMCE buttons
 */
function solucion_disable_styleselect( $buttons ) {
	if ( in_array( 'styleselect', $buttons ) ) {
		unset( $buttons['styleselect'] );
	}

	return $buttons;
}

add_filter( 'tiny_mce_before_init', 'solucion_tiny_mce_formats', 99 );
/**
 * Add our custom Flagship styles to the styleselect dropdown button.
 *
 * @since  1.4.0
 *
 * @param  $args array existing TinyMCE arguments
 *
 * @return $args array modified TinyMCE arguments
 *
 * @see    http://wordpress.stackexchange.com/a/128950/9844
 */
function solucion_tiny_mce_formats( $args ) {
	$solucion_formats = apply_filters('solucion_tiny_mce_formats',
		array(
			array(
				'title'    => __( 'DropCap', 'solucion' ),
				'selector' => 'p',
				'classes'  => 'u-dropcap',
				'wrapper'  => true,
			),
			array(
				'title'   => __( 'Pull Quote', 'solucion' ),
				'block'   => 'blockquote',
				'classes' => 'pullquote',
				'wrapper' => true,
			),
			array(
				'title'    => __( 'Intro Paragraph', 'solucion' ),
				'selector' => 'p',
				'classes'  => 'intro-paragraph u-lead',
				'wrapper'  => true,
			),
			array(
				'title'   => __( 'List Group', 'solucion' ),
				'items' => array(
					array(
						'title'    => __( 'Plain', 'solucion' ),
						'selector' => 'ul',
						'classes'  => 'u-list-group',
						'wrapper'  => true,
					),
					array(
						'title'    => __( 'Heart', 'solucion' ),
						'selector' => 'ul',
						'classes'  => 'u-list-group bullet-heart',
						'wrapper'  => true,
					),
					array(
						'title'    => __( 'Cross', 'solucion' ),
						'selector' => 'ul',
						'classes'  => 'u-list-group bullet-cross',
						'wrapper'  => true,
					),
				),
			),
			array(
				'title'   => __( 'Callout Box', 'solucion' ),
				'items' => array(
					array(
						'title'    => __( 'Primary color', 'solucion' ),
						'block'   => 'div',
						'classes' => 'u-p3 u-bg-1 u-f-plus u-text-wrap u-br u-mb2 u-shadow1',
						'wrapper' => true,
						'exact'   => true,
					),
					array(
						'title'    => __( 'Secondary color', 'solucion' ),
						'block'   => 'div',
						'classes' => 'u-p2 u-bg-2 u-f-plus u-text-wrap u-br u-mb2 u-shadow1',
						'wrapper' => true,
						'exact'   => true,
					),
					array(
						'title'    => __( 'Grey', 'solucion' ),
						'block'   => 'div',
						'classes' => 'u-p2 u-bg-silver u-f-plus u-text-wrap u-br u-mb2 u-shadow1',
						'wrapper' => true,
						'exact'   => true,
					),
				),
			),
			array(
				'title'   => __( 'Flex Grid', 'solucion' ),
				'block'   => 'div',
				'classes' => 'o-grid u-flex-ja',
				'wrapper' => true,
				'exact'   => true,
			),
			array(
				'title'  => __( 'Code Block', 'solucion' ),
				'format' => 'pre',
			),
			array(
				'title' => __( 'Buttons', 'solucion' ),
				'items' => array(
					array(
						'title'    => __( 'Standard', 'solucion' ),
						'selector' => 'a',
						'classes'  => 'btn',
						'exact'    => true,
					),
					array(
						'title'    => __( 'Primary Button', 'solucion' ),
						'selector' => 'a',
						'classes'  => 'btn u-bg-1',
						'exact'    => true,
					),
					array(
						'title'    => __( 'Hollow Button', 'solucion' ),
						'selector' => 'a',
						'classes'  => 'btn btn-hollow',
						'exact'    => true,
					),
				),
			),
		)
	);
	// Merge with any existing formats which have been added by plugins.
	if ( ! empty( $args['style_formats'] ) ) {
		$existing_formats = json_decode( $args['style_formats'] );
		$solucion_formats  = array_merge( $solucion_formats, $existing_formats );
	}

	$args['style_formats'] = json_encode( $solucion_formats );

	return $args;
}
