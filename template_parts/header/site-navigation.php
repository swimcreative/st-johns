<button class="menu-toggle animated" aria-expanded="false" >
	<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'kaiju' ); ?></span>
	<span></span><span></span><span></span>
</button>

<nav id="primary-nav" class="site-navigation" role="navigation">
		<ul class="main-menu menu desktop-menu">
		<?php
				wp_nav_menu( array(
						'menu'    => 'header-admissions',
						'container_class'				=> 'main-menu',
						'depth'             => 2,
						'container'         => false,
						'items_wrap' 				=> '%3$s',
						'walker'        => new Walker_Nav_Menu_Custom
				) );
				wp_nav_menu( array(
						'menu'    => 'header-academics',
						'container_class'				=> 'main-menu',
						'depth'             => 3,
						'container'         => false,
						'items_wrap' 				=> '%3$s',
						'walker'        => new Walker_Nav_Menu_Custom
				) );
				wp_nav_menu( array(
						'menu'    => 'header-school-life',
						'container_class'				=> 'main-menu',
						'depth'             => 2,
						'container'         => false,
						'items_wrap' 				=> '%3$s',
						'walker'        => new Walker_Nav_Menu_Custom
				) );



				echo '<li class="menu-button"><a href="/parent-portal">Parent Portal</a></li>';

				//add search form search-toggle
				echo '<li id="site-search" class="search-toggle">' . get_search_form( false ) . '</li>';
		?>
	</ul>

	<ul class="main-menu mobile-menu">

		<?php


						wp_nav_menu( array(
								'menu'    => 'mobile-menu',
								'container_class'				=> 'main-menu',
								'depth'             => 3,
								'container'         => false,
								'items_wrap' 				=> '%3$s',
								//'walker'        => new Walker_Nav_Menu_Custom
						) );
							echo '<li id="site-search" class="search-toggle">' . get_search_form( false ) . '</li>';
						?>
					</ul>
</nav><!-- #site-navigation -->
