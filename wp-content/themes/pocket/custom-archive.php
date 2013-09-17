<?php

/**
 * Template Name: Custom Archive
 *
 * Page template with various categorized archive posts.
 *
 * @package Pocket
 * @since Pocket 1.0
 */
?>

<?php get_header(); ?>
		
		<div id="content">
			<div class="posts">
	
				<!-- grab the posts -->
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				
				<article <?php post_class('post'); ?>>
					<!-- grab the video -->
					<?php if ( get_post_meta($post->ID, 'video', true) ) { ?>
						<div class="fitvid">
							<?php echo get_post_meta($post->ID, 'video', true) ?>
						</div>
					
					<?php } else { ?>
					
						<!-- grab the featured image -->
						<?php if ( has_post_thumbnail() ) { ?>
							<a class="featured-image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'large-image' ); ?></a>
						<?php } ?>
					
					<?php } ?>
					
					<div class="box-wrap">
						<div class="box">
							<header class="post-header">
								<div class="date-title"><?php echo get_the_date(); ?></div>
								
								<?php if(is_single() || is_page()) { ?>
									<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
								<?php } else { ?>					
									<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
								<?php } ?>
							</header>
							
							<!-- post content -->
							<div class="post-content">
								<?php the_content(); ?>
								
								<div id="archive">
									<div class="archive-col">
										<div class="archive-box">
											<h5><?php _e('Archive By Day','okay'); ?></h5>
											<ul>
												<?php wp_get_archives('type=daily&limit=15'); ?>
											</ul>
										</div>
										
										<div class="archive-box">
											<h5><?php _e('Archive By Month','okay'); ?></h5>
											<ul>
												<?php wp_get_archives('type=monthly&limit=12'); ?>
											</ul>
										</div>
										
										<div class="archive-box">
											<h5><?php _e('Archive By Year','okay'); ?></h5>
											<ul>
												<?php wp_get_archives('type=yearly&limit=12'); ?>
											</ul>
										</div>
									</div><!-- column -->
									
									<div class="archive-col">
										<div class="archive-box">
											<h5><?php _e('Latest Posts','okay'); ?></h5>
											<ul>
												<?php wp_get_archives('type=postbypost&limit=20'); ?>
											</ul>
										</div>
										
										<div class="archive-box">
											<h5><?php _e('Contributors','okay'); ?></h5>
											<ul>
												<?php wp_list_authors('show_fullname=1&optioncount=1&orderby=post_count&order=DESC'); ?>
											</ul>
										</div>
									</div><!-- column -->
									
									<div class="archive-col">
										<div class="archive-box">
											<h5><?php _e('Pages','okay'); ?></h5>
											<ul>
												<?php wp_list_pages('sort_column=menu_order&title_li='); ?>
											</ul>
										</div>
										
										<div class="archive-box">
											<h5><?php _e('Categories','okay'); ?></h5>
											<ul>
												<?php wp_list_categories('orderby=name&title_li='); ?> 
											</ul>
										</div>
									</div><!-- column -->
								</div><!-- archive -->
							</div><!-- post content -->
						</div><!-- box -->
					</div><!-- box wrap -->
				</article><!-- post-->	
				
				<?php endwhile; ?>
				<?php endif; ?>
			</div>
			
			<!-- post navigation -->
			<?php if( okay_page_has_nav() ) : ?>
				<div class="post-nav">
					<div class="post-nav-inside">
						<div class="post-nav-left"><?php previous_posts_link(__('<i class="icon-arrow-left"></i> Newer Posts', 'okay')) ?></div>
						<div class="post-nav-right"><?php next_posts_link(__('Older Posts <i class="icon-arrow-right"></i>', 'okay')) ?></div>	
					</div>
				</div>
			<?php endif; ?>
		</div><!-- content -->
	
		<!-- footer -->
		<?php get_footer(); ?>