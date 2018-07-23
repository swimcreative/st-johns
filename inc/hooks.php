<?php

function banner() {
	get_template_part('template_parts/acf/banner');
}
add_action('before_content','banner', 1);

function parent_top() {
if(is_page_template('parent-page-template.php') && !is_front_page()) {
	get_template_part('template_parts/page/parent-portal-grid');
	}
}

add_action('before_content','parent_top', 2);

function home_bottom() {
if(is_front_page()) {
	get_template_part('template_parts/page/home_about');
	get_template_part('template_parts/page/home_cta');
	}
}

add_action('after_content','home_bottom', 2);

function footer_bottom() {
	get_template_part('template_parts/footer/lower-footer');
}

add_action('after_footer','footer_bottom', 2);

function announcement() {
	if(is_page_template('parent-page-template.php') && !is_front_page()) {
	get_template_part('template_parts/page/parent-page-announcement');
	}
}

add_action('after_content','announcement', 2);


// nav item filters


//dd_filter('wp_nav_menu_items','add_search_box', 10, 2);

function add_search_box($items, $args) {

	if( $args->menu == 'header-academics' ) {
	ob_start();
	get_template_part('template_parts/nav/academics');
	$headers = ob_get_clean();
  return $headers.$items;
	}
	return $items;
}

function nav_support($menu) {
	$current = wp_get_nav_menu_object($menu);
	//ob_start();
	$support = '<div class="menu-support">';
	$support .= get_field('menu_support_content', $current);
	$support .= '</div>';
	return $support;
	//return ob_get_clean();
}
