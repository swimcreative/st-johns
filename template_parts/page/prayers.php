<?php


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
$query = new WP_Query( $args );

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



?>
