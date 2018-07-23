<div class="site-info">
	<p>&copy;<span><?php echo date('Y'); ?></span> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
	<?php echo wp_nav_menu(array('menu' => 'lower-footer-menu-1')); ?>
	<p class="legal"><a href="<?php echo esc_url( home_url( '/' ) ); ?>privacy" rel="home"><?php esc_html_e( 'Privacy Policy', 'kaiju' ); ?></a>&nbsp; &bull;&nbsp; <a href="<?php echo esc_url( home_url( '/' ) ); ?>terms" rel="home"><?php esc_html_e( 'Terms of Use', 'kaiju' ); ?></a></p>
</div><!-- .site-info -->
