<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package KAIJU
 */

if ( ! get_field('page_right_sidebar') ) {
	return;
}
?>

<aside id="tertiary" class="widget-area" role="complementary">
		<?php //dynamic_sidebar( 'sidebar-1' ); ?>
		<?php the_field('page_right_sidebar'); ?>
</aside>
