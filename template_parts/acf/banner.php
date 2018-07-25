<section id="banner" <?php if(is_front_page()) : echo 'class="hero"'; endif; ?> <?php if(get_the_post_thumbnail()) :
  echo 'style="background-image:url('.get_the_post_thumbnail_url().')"'; endif; ?>>
  <div class="container">
    <div class="banner-content">
      <?php if(!is_front_page()) : ?>

      <h1><?php

      if(get_field('banner_heading')) :

        echo get_field('banner_heading');

      else:

        if(!is_home() && !is_archive()) :

        if(is_singular('post')) :

          get_template_part('template_parts/post/post-banner-head');

          else :

            if(is_search()) : ?>

              	<small class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'kaiju' ), '<span><h1 style="margin-top:15px;font-size:2em;font-style:normal">' . get_search_query() . '</h1></span>' ); ?></small>

            <?php   else :

            echo get_the_title();

          endif;

        endif;

        else :

        if(is_archive()) :

          $cat = get_the_category();
          echo '<small style="padding-bottom:10px">Category:</small>';
          echo $cat[0]->name;
          echo the_archive_description( '<div class="taxonomy-description">', '</div>' );

        else :

        echo 'News + Bulletins';

        endif;

      endif;

      endif; ?>

      <?php if(is_404()) :

        echo '<h1 style="font-size:6em">404<small style="font-size:2rem">Page Not Found</small></h1>';

      endif; ?>


      <?php if(get_field("banner_sub_heading")) : ?><small><?php echo get_field("banner_sub_heading"); ?></small><?php endif; ?></h1>

      <?php else : ?>

      <?php echo get_field('hero'); ?>

      <?php endif; ?>
    </div>

    <?php if(is_front_page()) :

      $blog_id = get_current_blog_id();

      if ( 1 == $blog_id ) :

      $id = array('stjohnschoolchurch@gmail.com','p2g5ltakbpnuctkql5gb6bgsrk@group.calendar.google.com');

      else :

      $id = 'gta4795vc1eaj2ld49k9ata6d4@group.calendar.google.com';

      endif;

      $num = 12;

      swim_calendar_widget($id, $num);

      else :

      crumbs();

    endif;?>
  </div>
</section>
