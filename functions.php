<?php
/**
 * components functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package KAIJU
 */

/**
 * Assign the KAIJU version to a var
 */
$theme            = wp_get_theme();
$kaiju_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
 $content_width = 1280; /* pixels */
}

$kaiju = (object) array(
	'version' => $kaiju_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-theme.php',
	'customizer' => require 'inc/customizer/class-customizer.php',
  'cpt'        => require 'inc/class-cpt.php',
);

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load custom widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Load custom shortcodes
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Load custom hooks
 */
require get_template_directory() . '/inc/hooks.php';

/**
 * Load Jetpack compatibility file.
 */
if ( class_exists( 'Jetpack' ) ) {
	$kaiju->jetpack = require 'inc/jetpack/class-jetpack.php';
}

/**
 * Load acf compatibility file.
 */
if ( class_exists( 'acf' ) ) {
	$kaiju->acf = require 'inc/acf/acf.php';
}

/**
 * Custom post types & taxonomies
 */
if ( class_exists( 'CPT' ) ) {
  //cpt
  $work = new CPT(
    array(
      'post_type_name' => 'Prayer',
      'singular' => 'Prayer',
      'plural' => 'Prayers',
      'slug' => 'prayer'
    ),
    array(
      'supports' => array('title', 'editor', 'thumbnail'),
      'menu_icon' => 'dashicons-book-alt',
      'publicly_queryable' => false
    )
  );

}



function create_private_type_tax()
{
    register_taxonomy(
        'grade',
        'prayer',
        array(
            'label' => __('Grade Levels'),
            'public' => true,
            'rewrite' => true,
            'hierarchical' => true,
            'show_admin_column' => true,
        )
    );
}

add_action('init', 'create_private_type_tax');

// Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	//unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	//unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}

//add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

// Or just remove them all in one line
//add_filter( 'woocommerce_enqueue_styles', '__return_false' );

function get_excerpt($limit, $source = null){
    global $post;
    if($source == "content" ? ($excerpt = get_the_content()) : ($excerpt = get_the_excerpt()));
    $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
    $excerpt = $excerpt.'...';
    return $excerpt;
}
