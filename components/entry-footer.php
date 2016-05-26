<?php if ( ! is_single( get_the_ID() ) ) {
	return;
} ?>
<footer <?php hybrid_attr( 'entry-footer' ); ?>>
	<?php hybrid_post_terms( array( 'taxonomy' => 'category', 'text' => esc_html__( 'Posted in %s', 'solucion' ) ) ); ?>
	<?php hybrid_post_terms( array( 'taxonomy' => 'post_tag', 'text' => esc_html__( 'Tagged %s', 'solucion' ), 'before' => '<br />' ) ); ?>
</footer><!-- .entry-footer -->
