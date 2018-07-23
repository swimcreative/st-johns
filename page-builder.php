<?php
/**
 * Template Name: Page Builder
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package KAIJU
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'blocks' ); if(function_exists('live_edit')) { live_edit('post_title'); } ?>>
				<div class="entry-content">

					<?php if ( class_exists( 'acf' ) ) {

// check if the flexible content field has rows of data
if( have_rows('blocks') ):

		$block_id = 1;
    // loop through the rows of data
    while ( have_rows('blocks') ) : the_row();
				if( get_row_layout() == 'simple_block' ):
					kaiju_block('simple_block' , $block_id);

        elseif( get_row_layout() == 'hero_block' ):
					kaiju_block('hero_block' , $block_id);

				elseif( get_row_layout() == 'dynamic_block' ):
					kaiju_block('dynamic_block' , $block_id);

				elseif( get_row_layout() == 'media_block' ):
					kaiju_block('media_block' , $block_id);

				elseif( get_row_layout() == 'toggle_block' ):
					kaiju_block('toggle_block' , $block_id);

				elseif( get_row_layout() == 'map_block' ):
					kaiju_block('map_block' , $block_id);

        endif;

		$block_id++;
    endwhile;

else :

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit this page %s', 'kaiju' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link"><em>No Blocks to display. ',
		'to add some.</em></span>'
	);

endif;

} else {
	get_template_part( 'template_parts/page/content', 'page' );
}

?>


				</div>
				<footer class="entry-footer">
					<?php
						edit_post_link(
							sprintf(
								/* translators: %s: Name of current post */
								esc_html__( 'Edit %s', 'kaiju' ),
								the_title( '<span class="screen-reader-text">"', '"</span>', false )
							),
							'<span class="edit-link">',
							'</span>'
						);
					?>
				</footer>
			</article><!-- #post-## -->

			<?php endwhile; // End of the loop. ?>
		</main>
	</div>
<?php
get_footer();
