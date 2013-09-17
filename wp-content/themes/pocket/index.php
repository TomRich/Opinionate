<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Pocket
 * @since Pocket 1.0
 */

get_header(); ?>

	<div id="content">
		<div class="posts">
			<!-- titles -->
			<?php if ( is_search() ) { ?>
				<h2 class="archive-title"><i class="icon-search"></i>
					<?php
					global $wp_query;
					printf( __( '%d results for "%s"', 'okay' ), $wp_query->found_posts, get_search_query( true ) );
					?>
				</h2>
			<?php } else if ( is_tag() ) { ?>
				<h2 class="archive-title"><i class="icon-tag"></i> <?php single_tag_title(); ?></h2>
			<?php } else if ( is_day() ) { ?>
				<h2 class="archive-title">
					<i class="icon-time"></i> <?php _e( 'Archive:', 'okay' ); ?> <?php echo get_the_date(); ?></h2>
			<?php } else if ( is_month() ) { ?>
				<h2 class="archive-title"><i class="icon-time"></i> <?php echo get_the_date( 'F Y' ); ?></h2>
			<?php } else if ( is_year() ) { ?>
				<h2 class="archive-title"><i class="icon-time"></i> <?php echo get_the_date( 'Y' ); ?></h2>
			<?php } else if ( is_404() ) { ?>
				<h2 class="archive-title">
					<i class="icon-warning-sign"></i> <?php _e( 'Page Not Found!', 'okay' ); ?></h2>
			<?php } else if ( is_category() ) { ?>
				<h2 class="archive-title"><i class="icon-reorder"></i> <?php single_cat_title(); ?></h2>
			<?php } else if ( is_author() ) { ?>
				<h2 class="archive-title"><i class="icon-pencil"></i>
					<?php
					$curauth = ( get_query_var( 'author_name' ) ) ? get_user_by( 'slug', get_query_var( 'author_name' ) ) : get_userdata( get_query_var( 'author' ) );
					echo $curauth->display_name;
					?>
				</h2>
			<?php } ?>

			<div id="post-block">
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
	</div><!-- content -->

	<!-- footer -->
<?php get_footer(); ?>