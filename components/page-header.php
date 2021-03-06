<?php if ( is_home() || is_front_page() ) {
	return;
}
?>

<div <?php hybrid_attr( 'archive-header' ); ?>>

	<?php hybrid_get_menu( 'breadcrumbs' ); ?>

	<h1 <?php hybrid_attr( 'archive-title' ); ?>>
		<?php
		if ( is_archive() ) {
			echo get_the_archive_title();
		} elseif ( is_search() ) {
			echo sprintf( esc_html__( 'Search Results for %s', 'solucion' ), get_search_query() );
		} elseif ( is_404() ) {
			echo esc_html__( 'Not Found', 'solucion' );
		} elseif ( ! hybrid_is_plural() ) {
			echo get_the_title();
		}
		?>
	</h1>
	<?php if ( ! is_paged() && $desc = get_the_archive_description() ) : // Check if we're on page/1. ?>

		<article <?php hybrid_attr( 'archive-description' ); ?>>
			<?php echo $desc; ?>
		</article><!-- .archive-description -->

	<?php endif; // End paged check. ?>
</div>
