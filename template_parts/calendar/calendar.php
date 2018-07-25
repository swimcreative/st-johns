<?php
if(isset($atts['num_posts'])) {
  $num = $atts['num_posts'];
} else {
  $num = -1;
}

$num = 6;

//$id = 'vhrhc2ddghd7m61597k4j5f060@group.calendar.google.com';


$blog_id = get_current_blog_id();

if ( 1 == $blog_id ) :

$id = array('stjohnschoolchurch@gmail.com','p2g5ltakbpnuctkql5gb6bgsrk@group.calendar.google.com');

else :

$id = 'gta4795vc1eaj2ld49k9ata6d4@group.calendar.google.com';

endif;

swim_calendar_widget($id, $num);
