<div class="site-contact">
	<?php
  if(has_custom_logo()) {
  	echo get_custom_logo() . '<br>';
  } else {
    echo '<a href="' . esc_url( home_url( '/' ) ) . '" rel="home"><span class="contact-info-title">' . get_bloginfo('name') . '</span></a><br>';
  }

	echo '<strong>'.get_bloginfo('title').'</strong><br>';

	$address = nl2br(get_theme_mod('kaiju_address'));
	if ($address != '') {
		echo '<span class="contact-info-address">' . $address . '</span><br>';
	}
	if (get_theme_mod('kaiju_phone') != '') {
		echo '<span class="contact-info-phone"><abbr title="Phone Number">PH</abbr>: <a href="tel:' . get_theme_mod('kaiju_phone'). '">' . get_theme_mod('kaiju_phone') . '</a></span>';
	}
	if (get_theme_mod('kaiju_email') !='' ) {
		echo '<span class="contact-info-email"><abbr title="Email Address">E</abbr>: <a href="mailto:' . get_theme_mod('kaiju_email'). '">' . get_theme_mod('kaiju_email') . '</a></span>';
	}
	?>
</div><!-- .site-contact -->

<?php

//GET ADDRESS LINE BY LINE
/*
$address = '';
$lines = explode("\n", get_theme_mod('kaiju_address'));
$i = 1;
foreach ($lines as $line) {
  if($i == 1) {
    $address .= '<span>'.$line.'</span>';
  } else {
    $address .= '<br><span>'.$line.'</span>';
  }
  $i++;
}
*/

?>
