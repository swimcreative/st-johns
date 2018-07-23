<?php

//CONTACT INFO
class kaiju_contact_info extends WP_Widget {

	function __construct() {
		// Instantiate the parent object
		parent::__construct( false, 'Contact Info' );
	}

	function widget( $args, $instance ) {

    extract($args, EXTR_SKIP);

    echo $before_widget;
    $title = empty($instance['title']) ? 'Contact Info' : apply_filters('widget_title', $instance['title']);

    if ($title === ' ') {
      //do nothing
	} else {
		echo $before_title . $title . $after_title;
	}

  echo '<span class="contact-info-title">' . get_bloginfo('name') . '</span><br>';
	echo '<span class="contact-info-address">' . nl2br(get_theme_mod('kaiju_address')) . '</span><br>';
	echo '<span class="contact-info-phone"><abbr title="Phone Number">PH</abbr>: ' . get_theme_mod('kaiju_phone') . '</span><br>';
	echo '<span class="contact-info-email"><abbr title="Email Address">E</abbr>: ' . get_theme_mod('kaiju_email') . '</span>';

	echo $after_widget;

    }

	function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }

	 function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = $instance['title'];
	?>
	  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
	<?php
	  }
}


function kaiju_register_widgets() {
	register_widget( 'kaiju_contact_info' );
}

add_action( 'widgets_init', 'kaiju_register_widgets' );


// calendar display (with ID argument)
function swim_calendar_widget($cal_id, $num = 6) {

// set current time zone cus wordpress suks?
date_default_timezone_set('America/Chicago');

ob_start();

$api = 'AIzaSyAQsBtu94oMVIY9AeeN0WAdUxICs8xK7_M';

if(!is_array($cal_id)) : // if is only one

$id =  $cal_id;
$url = 'https://www.googleapis.com/calendar/v3/calendars/'.$id.'/events?key='.$api.'&orderBy=startTime&singleEvents=true';
$url = file_get_contents($url);
$json = json_decode($url, true);

$events = $json['items'];

else : // if is an array of IDs

//$combo = array();

foreach($cal_id as $cal) :

	$id =  $cal;
	$url = 'https://www.googleapis.com/calendar/v3/calendars/'.$id.'/events?key='.$api.'&orderBy=startTime&singleEvents=true';
	$url =  file_get_contents($url);
	$json = json_decode($url, true);
	$combo[] = $json['items'];

endforeach;

$events = array();

foreach ($combo as $e) {
	array_push($events, $e);
}

$events = call_user_func_array('array_merge', $events);

foreach ($events as $key => $part) {
		if(isset($part['start']['dateTime'])) :
		 $sort[$key] = strtotime($part['start']['dateTime']);
		 else :
		 $sort[$key] = strtotime($part['start']['date']);
	 endif;
}
// sort all combined items by date
array_multisort($sort, SORT_ASC, $events);

endif;

// pretty print test
//print("<pre>".print_r($events,true)."</pre>");

?>

<div class="calendar-widget">
<h2 class="widget-title">Upcoming Events</h2>
<a class="view-all" href="/calendar">View all</a>
<table class="calendar table">
<tbody>
<?php

if($num == -1) {
	$num = 100; // if u want all events, make similar to wp query expectaion
} else {
	$num = $num; // get the provided argument
}

//echo $num;

$i = 1;
foreach($events as $event) {

  $current = strtotime('now');
	if(isset($event['start']['dateTime'])) : // if has specified times, use times
  	$date = strtotime($event['start']['dateTime']);
  	$month = strtoupper(date('M', $date));
  	$day =  date('j', $date);
	elseif(isset($event['start']['date'])) : // if is all day event, only query by the day
		$date = strtotime($event['start']['date']);
	  $month = strtoupper(date('M', $date));
	  $day =  date('j', $date);
	else :
		$day = '';
		$month = '';
	endif;

  // ensure future dates only
  if($date > $current && $i <= $num) : ?>

	<tr>
  	<td>
			<span><span><?php echo $month; ?><span><?php echo $day; ?></span></span></span>

			<?php if(isset($event['start']['date']) && !isset($event['start']['dateTime']) && isset($event['end']['date']) && !isset($event['end']['dateTime'])) :
		  ?>
						<!--<span><span><?php echo $month; ?><span><?php echo $event['end']['date']; ?></span></span></span> -->

			<?php endif; ?>

		</td>
  	<td><?php echo $event['summary'];
		// if not an all-day event;
				if(isset($event['start']['dateTime'])) :
					$start = strtotime($event['start']['dateTime']);
					$end = strtotime($event['end']['dateTime']);
					echo '<br><small style="text-transform:uppercase;display:block;margin-top:5px;">'.date('g:ia', $start).' &ndash; '.date('g:ia', $end).'</small>';
				endif; ?>

		</td>
	</tr>

	<?php $i++; endif; } ?>

	</tbody>
</table>
</div>

<?php
	echo ob_get_clean(); // output the calendar
}

// SECONDARY NAV
function stjohns_side_nav() {

	global $post;
	$current = get_the_title();
  $link = get_the_permalink($post->ID);

	if ( is_page() && $post->post_parent )

	    $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0&depth=1' );
	else
	    $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0&depth=1' );

	if ( $childpages ) {

	    $string = '<strong>'.$current.'</strong><br><br><ul>' . $childpages . '</ul>';

	} else {

	$children = get_pages( array( 'child_of' => $post->ID ) );

   if ( is_page() && ($post->post_parent || count( $children ) > 0  )) {

			$parent = wp_get_post_parent_id( $post->ID );
			$link = get_the_permalink($parent);
			$parent = get_the_title($parent);
			$childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0&depth=1' );

			$string = '<strong><a href="'.$link.'">'.$parent.'</a></strong><br><br><ul>' . $childpages . '</ul>';

		} else {

			$string = '<strong><a href="'.get_the_permalink().'">'.get_the_title().'</a></strong>';

				// nada, hide empty widget with CSS

		}
	}

	echo $string;

}

//SIDE NAV WIDGET
class stjohns_sidenav extends WP_Widget {

	function  stjohns_sidenav() {
		// Instantiate the parent object
		parent::__construct( false, 'Side Navigation' );
	}

	function widget( $args, $instance ) {

    extract($args, EXTR_SKIP);

    echo $before_widget;
    $title = empty($instance['title']) ? 'Side Navigation' : apply_filters('widget_title', $instance['title']);

    if ($title === ' ') {
      //do nothing
	} else {
		//echo $before_title . $title . $after_title;
	}

  stjohns_side_nav();

	echo $after_widget;

    }

	function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }

	 function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = $instance['title'];
	?>
	  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
	<?php
	  }
}

function stjohns_register_widgets() {
	register_widget( 'stjohns_sidenav' );
}

add_action( 'widgets_init', 'stjohns_register_widgets' );
