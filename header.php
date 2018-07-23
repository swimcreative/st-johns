<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package KAIJU
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'kaiju' ); ?></a>

	<section id="upper-head">
		<div class='container'>

			<?php
			  $blog_id = get_current_blog_id();
		   	if ( 1 == $blog_id ) : ?>
					<style>
					.site-1 a {
						color:white !important;
						border-bottom:1px solid white;
						pointer-events:none;
						padding-bottom:0 !important;
						display:inline-block;
						line-height:1.3;
					}
					</style>
	 		<?php else :  ?>
				<style>
				.site-2 a {
					color:white !important;
					border-bottom:1px solid white;
					pointer-events:none;
					padding-bottom:0 !important;
					display:inline-block;
					line-height:1.3;
				}
				</style>
			<?php endif;
			?>
			<?php echo wp_nav_menu(array('menu' => 'multisite-navigation')); ?>
			<?php echo wp_nav_menu(array('menu' => 'secondary-navigation')); ?>
		</div>
	</section>
	<header id="masthead" class="site-header scroll-nav" role="banner">

		<div class="container">

		<?php get_template_part( 'template_parts/header/site', 'branding' ); ?>
		<?php get_template_part( 'template_parts/header/site', 'navigation' ); ?>

		</div>

	</header>

	<?php do_action('before_content'); ?>

	<div id="content" class="site-content">
		<?php if( ! is_page_template('page-builder.php') ) {
			echo '<div class="container"><div class="row">';
		} ?>
