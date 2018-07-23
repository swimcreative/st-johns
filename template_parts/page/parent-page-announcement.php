<?php if(get_field('parent_portal_announcement')) : ?>
<section id="announcement">
	<div class="container">
		<?php if(get_field('supporting_image')) : ?>
			<img src="<?php echo get_field('supporting_image')['sizes']['large']; ?>"/>
		<?php endif; ?>
	<div class="annountement-content">
		<?php echo get_field('parent_portal_announcement'); ?>
	</div>
</div>
</section>
<?php endif; ?>
