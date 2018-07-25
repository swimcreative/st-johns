<?php

if($grade == 'all') :

	$args = array(
		'post_type' => 'prayer',
		'orderby' => 'title',
		'order' => 'ASC',
		'posts_per_page' => -1,
	);

else :


$args = array(
	'post_type' => 'prayer',
	'orderby' => 'title',
	'order' => 'ASC',
	'posts_per_page' => -1,
	'tax_query' => array(
		array(
			'taxonomy' => 'grade',
			'field'    => 'slug',
			'terms'    => $grade,
		),
	),
);

endif;


$query = new WP_Query( $args );

if($grade != 'all') :

if ( $query->have_posts() ) {
	echo '<div class="prayer-list"><ul>';
	while ( $query->have_posts() ) {
	$query->the_post();

	echo '<li>'.get_the_title().'</li>';

	}
	echo '</ul></div>';
	/* Restore original Post Data */
	wp_reset_postdata();
} else {
	// no posts found
}

else :

	if ( $query->have_posts() ) {
		echo '<div class="prayer-list">';
		while ( $query->have_posts() ) {
		$query->the_post();

		echo '<h3>'.get_the_title().'</h3>';
		echo get_the_content();
		echo '<hr>';

		}
		echo '</div>';
		/* Restore original Post Data */
		wp_reset_postdata();
	} else {
		// no posts found
	}

endif;



?>
