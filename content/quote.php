<?php
/**
 * Quote post format template part.
 *
 * @package solucion
 */

?>
<article <?php hybrid_attr( 'post' ); ?>>
		<?php tha_entry_content_before(); ?>
		<?php the_content(); ?>
		<?php tha_entry_content_after(); ?>
</article>
