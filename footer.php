<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package KAIJU
 */

?>
<?php if( ! is_page_template('page-builder.php') ) {
	echo '</div></div>';
} ?>
	</div>

	<?php do_action('after_content'); ?>


	<footer id="colophon" class="site-footer" role="contentinfo">
		<img class="footer-bg-image" src="<?php echo get_stylesheet_directory_uri().'/assets/img/shield.png'; ?>"/>
		<div class="container">
		<?php get_template_part( 'template_parts/footer/site', 'morefoot' ); ?>
		<!-- <p class="top-link">
  		<a href="#">Back to top</a>
  	</p> -->
		<?php get_template_part( 'template_parts/footer/site', 'contact' ); ?>
		</div>
	</footer>
	<?php do_action('after_footer'); ?>
</div>
<?php wp_footer(); ?>

</body>
</html>
