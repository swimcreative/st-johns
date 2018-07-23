<section id="footer-bottom">
	<div class="container">
		<h5>Connect with St. John's</h5>
		<?php get_template_part( 'template_parts/footer/site', 'social' ); ?>
		<?php echo wp_nav_menu(array('menu' => 'secondary-navigation')); ?>
		<?php get_template_part( 'template_parts/footer/site', 'info' ); ?>
		<?php //get_template_part( 'template_parts/footer/site', 'credits' ); ?>
	</div>
</section>
