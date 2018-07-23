<?php // shortcodes
function name_code() {
  $name = get_bloginfo('name');
  return $name;
}
add_shortcode('name', 'name_code');

function phone_code() {
  if (get_theme_mod('kaiju_phone')=='')
    return;
  $phone = '<a href="tel:' . get_theme_mod('kaiju_phone') . '">' . get_theme_mod('kaiju_phone') . '</a>';
  return $phone;
}
add_shortcode('phone', 'phone_code');

//Address
function address_code($atts) {
  if (get_theme_mod('kaiju_address')=='')
    return;
  extract( shortcode_atts( array(
    'format' => true
  ), $atts ) );
  if($format === true) {
    $addy = nl2br(get_theme_mod('kaiju_address'));
  } else {
    $lines = preg_split( "/\\r\\n|\\r|\\n/", get_theme_mod('kaiju_address') );
    $count = count($lines);
    $addy = '';

    for( $i = 0; $i <= $count; $i++ ) {
      $addy .= $lines[$i];
      if($i < $count - 1) {
        $addy .= ', ';
      }
    }//for
  }//else

  return $addy;
}
add_shortcode('address', 'address_code');

// Email
function email_code() {
  if (get_theme_mod('kaiju_email')=='')
    return;
  $e = '<a href="mailto:' . get_theme_mod('kaiju_email') . '">' . get_theme_mod('kaiju_email') . '</a>';
  return $e;
}
add_shortcode('email', 'email_code');


// Calendar
function calendar_code($atts) {
  ob_start();
  include get_stylesheet_directory().'/template_parts/calendar/calendar.php';
  return ob_get_clean();
}
add_shortcode('calendar', 'calendar_code');

// News
function news_code($atts) {
  ob_start();
  include get_stylesheet_directory().'/template_parts/news/news.php';
  return ob_get_clean();
}
add_shortcode('news', 'news_code');


//PRAYERS SHORTCODE

function stjohns_prayers( $type ) {

  extract(shortcode_atts(array(
    'grade' => 'grade'
  ), $type));

  $grade = $type['grade'];
  
  ob_start();
  include get_stylesheet_directory().'/template_parts/page/prayers.php';
  return ob_get_clean();

}


add_shortcode( 'prayers', 'stjohns_prayers' );
