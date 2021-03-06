<?php
/**
 * Nothing found template.
 *
 * @package solucion
 */

?>
<article class="no-results not-found u-mx-auto u-mb2">
	<div class="page-content">

		<?php if ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search. Perhaps try again with some different keywords.', 'solucion' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'solucion' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>

	</div><!-- .page-content -->
</article><!-- .no-results -->
