<?php
/**
 * Video format single page template.
 *
 * @package solucion
 */

?>

<article <?php hybrid_attr( 'post' ); ?>>

	<?php echo ( $video = hybrid_media_grabber( array( 'type' => 'video', 'split_media' => true ) ) ); ?>

	<?php tha_entry_top(); ?>

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php tha_entry_content_before(); ?>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
			<?php tha_entry_content_after(); ?>
		</div>

		<?php get_template_part( 'components/entry', 'footer' ); ?>

		<?php comments_template( '', true ); ?>

	<?php tha_entry_bottom(); ?>

</article>
