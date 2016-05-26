<?php

hybrid_post_terms(array(
	'taxonomy' => 'category',
	'text'     => __('Posted in %s', 'solucion'),
));

hybrid_post_terms(array(
	'taxonomy' => 'post_tag',
	'text'     => __('Tagged %s', 'solucion'),
	'before'   => '<br />',
));
