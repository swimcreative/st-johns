<?php

if(isset($atts['num_posts'])) {
  $num = $atts['num_posts'];
} else {
  $num = 3;
}

$args = array(
	'posts_per_page'   => $num,
	'orderby'          => 'date',
	'order'            => 'DESC',
  'post_type' => 'post',
);


$posts = get_posts( $args );

if($posts) : global $post; ?>

<div class="news-widget">
<h2 class="widget-title">News &amp; Bulletins</h2>
<a class="view-all" href="/blog">View all</a>
<table class="news table">
<tbody>

<?php foreach ( $posts as $post ) : setup_postdata( $post );?>

<tr>
  <td><span><?php echo get_the_date(); ?></span>
    <a href="<?php echo get_the_permalink(); ?>"><h6><?php echo get_the_title(); ?></h6></a>
    <p><?php echo get_excerpt(80); ?></p><a href="<?php echo get_the_permalink(); ?>">READ MORE</a>
    </td>
</tr>

<?php endforeach; wp_reset_postdata(); ?>

</tbody>
</table>
<!--<a class="btn" href="/news">All News</a> -->
</div>

<?php else : ?>

  <div class="news-widget">
  <h2 class="widget-title">News &amp; Bulletins</h2>
  <table class="news table">
    Check back soon for upcoming news & bulletins!

  </table>
</div>
</div>

<?php endif; ?>
