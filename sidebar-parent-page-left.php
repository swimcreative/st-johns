<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package KAIJU
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
		<!--	<h4>Parent Page Sidebar Left</h4> -->
	<?php dynamic_sidebar( 'sidebar-3' ); ?>
</aside>
