<?php
			//show category
			$category = get_the_category();
			if($category) {

			echo '<a class="cat-link" href="' . get_category_link( $category[0]->term_id) . '">' . $category[0]->cat_name . '</a>';

			}

			the_title( '<h1 style="padding-left:0" class="entry-title">', '</h1>' );

	if ( 'post' === get_post_type() ) : ?>
	<?php get_template_part( 'template_parts/post/content', 'meta' ); ?>
	<?php
	endif; ?>
