<?php /* Template Name: Example Page Template */ ?>
<?php get_header(); ?>
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	<div id="gallery-1" class="gallery galleryid-142 gallery-columns-3 gallery-size-thumbnail">
		<?php include('./dasher-tools/pinterest_query.php'); ?>
        <?php include('./dasher-tools/twitter-gather.php'); ?>
			<br style="clear: both;">
			<br style="clear: both;">
		</div>
	<?php endwhile; ?>
    <?php endif; ?>

<?php get_footer(); ?>