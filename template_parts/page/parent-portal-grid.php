<section id="parent-portal-grid">
	<div class="container">
		<div class="grid-wrapper">

		<?php $rows = 'portal_grid';
		if(have_rows($rows)) : while(have_rows($rows)) : the_row(); ?>
		<div class="item">
			<img src="<?php echo get_sub_field('portal_icon')['sizes']['thumbnail']; ?>"/>
			<h2><?php echo get_sub_field('portal_headline'); ?></h2>
				<p><?php echo get_sub_field('portal_description'); ?></p>

				<?php $links = 'portal_links';

				if(have_rows($links)) : while(have_rows($links)) : the_row(); ?>

				<?php if(get_sub_field('link_or_file') == 'link') : ?>

				<a <?php if(get_sub_field('portal_link')['target'] == '_blank') : echo 'target="_blank" '; endif; ?> href="<?php echo get_sub_field('portal_link')['url']; ?>"><?php echo get_sub_field('portal_link')['title']; ?></a>

				<?php else : ?>

				<a target="_blank" href="<?php echo get_sub_field('portal_file')['url']; ?>"><?php echo get_sub_field('portal_file_title'); ?></a>

				<?php endif; ?>

				<?php endwhile; endif; ?>
		</div>

	<?php endwhile; endif; ?>

	</div>
</div>
</section>
