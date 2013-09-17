<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Pocket
 * @since Pocket 1.0
 */

get_header(); ?>

	<div id="content">
		<div class="posts">
			<!-- grab the posts -->
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<!-- uses the post format -->
				<?php
				if ( ! get_post_format() ) {
					get_template_part( 'format', 'standard' );
				} else {
					get_template_part( 'format', get_post_format() );
				};
				?>

			<?php endwhile; ?>
			<?php endif; ?>
		</div>

		<!-- post navigation -->
		<?php if ( okay_page_has_nav() ) : ?>
			<div class="post-nav">
				<div class="post-nav-inside">
					<div class="post-nav-left"><?php previous_posts_link( __( '<i class="icon-arrow-left"></i> Newer Posts', 'okay' ) ) ?></div>
					<div class="post-nav-right"><?php next_posts_link( __( 'Older Posts <i class="icon-arrow-right"></i>', 'okay' ) ) ?></div>
				</div>
			</div>
		<?php endif; ?>

		<!-- comments -->
		<?php if ( is_single() ) { ?>
			<?php
			global $post;
			if ( 'open' == $post->comment_status ) {
				?>
				<div id="comment-jump" class="comments">
					<?php comments_template(); ?>
				</div>
			<?php } ?>
		<?php } ?>
	</div><!-- content -->

	<!-- footer -->
<?php get_footer(); ?>