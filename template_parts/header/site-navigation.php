<button class="menu-toggle animated" aria-expanded="false" >
	<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'kaiju' ); ?></span>
	<span></span><span></span><span></span>
</button>

<nav id="primary-nav" class="site-navigation" role="navigation">
		<ul class="main-menu menu desktop-menu">
		<?php

		$blog_id = get_current_blog_id();
		if ( 1 == $blog_id ) :

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


				else :

					wp_nav_menu( array(
							'menu'    => 'header-worship',
							'container_class'				=> 'main-menu',
							'depth'             => 2,
							'container'         => false,
							'items_wrap' 				=> '%3$s',
							'walker'        => new Walker_Nav_Menu_Custom
					) );
					wp_nav_menu( array(
							'menu'    => 'header-faith-formation',
							'container_class'				=> 'main-menu',
							'depth'             => 3,
							'container'         => false,
							'items_wrap' 				=> '%3$s',
							'walker'        => new Walker_Nav_Menu_Custom
					) );
					wp_nav_menu( array(
							'menu'    => 'header-community-outreach',
							'container_class'				=> 'main-menu',
							'depth'             => 2,
							'container'         => false,
							'items_wrap' 				=> '%3$s',
							'walker'        => new Walker_Nav_Menu_Custom
					) );


					echo '<li class="menu-button"><a href="/support"><span  style="margin-right:0px;position:relative;left:-5px;font-size:1.3rem;display:inline-block;vertical-align:middle" class="genericon genericon-heart"></span>&nbsp;Support</a></li>';


				endif;


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
