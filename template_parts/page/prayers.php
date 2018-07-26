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
	global $post;
	echo '<li><a href="/academics/prayers-religion#'.$post->post_name.'">'.get_the_title().'</a></li>';

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
		global $post;
		echo '<section id="'.$post->post_name.'">';
		echo '<h3>'.get_the_title().'</h3>';
		echo get_the_content();
		echo '</section>';
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
