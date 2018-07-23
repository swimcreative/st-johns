<?php
if(isset($atts['num_posts'])) {
  $num = $atts['num_posts'];
} else {
  $num = -1;
}

$num = 6;

//$id = 'vhrhc2ddghd7m61597k4j5f060@group.calendar.google.com';

$id = array('stjohnschoolchurch@gmail.com','p2g5ltakbpnuctkql5gb6bgsrk@group.calendar.google.com');

swim_calendar_widget($id, $num);
