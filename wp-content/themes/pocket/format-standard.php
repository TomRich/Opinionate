<?php

/**
 * Template for standard posts.
 *
 * @package Pocket
 * @since Pocket 1.0
 */
?>

					<article <?php post_class( 'post' ); ?>>
						<!-- grab the video -->
						<?php if ( get_post_meta($post->ID, 'video', true) ) { ?>
							<div class="fitvid">
								<?php echo get_post_meta($post->ID, 'video', true) ?>
							</div>
						
						<?php } else { ?>
						
							<!-- grab the featured image -->
							<?php if ( has_post_thumbnail() ) { ?>
								<a class="featured-image <?php if ( get_option('okay_theme_customizer_bw_disable') == 'enable' ) { ?>grayscale<?php } ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'large-image' ); ?></a>
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
									<?php if(is_search() || is_archive()) { ?>
										<div class="excerpt-more">
											<?php okay_readmore(); ?>
										</div>
									<?php } else { ?>
										<?php the_content(__( '- Read More -','okay')); ?>
										
										<?php if(is_single() || is_page()) { ?>
											<div class="pagelink">
												<?php wp_link_pages(); ?>
											</div>
										<?php } ?>
										
										<?php if(is_single()) { ?>
											<ul class="meta">
												<li>
												<i class="icon-pencil"></i> <?php the_author_posts_link(); ?></li>
												<li><i class="icon-time"></i> <?php echo get_the_date(); ?></li>
												<li><i class="icon-list-ul"></i> <?php the_category(', '); ?></li>
												<?php $posttags = get_the_tags(); if ($posttags) { ?>
													<li><i class="icon-tag"></i> <?php the_tags('', ', ', ''); ?></li>
												<?php } ?>
												
												<?php if(is_single()) { ?>	
													<li class="next-prev-mobile">&nbsp;</li>
													<li class="prev-mobile next-prev-mobile"><?php previous_post_link('%link', '<i class="icon-arrow-left"></i> Previous Post'); ?></li>
													<li class="next-prev-mobile"><?php next_post_link('%link', '<i class="icon-arrow-right"></i> Next Post'); ?></li>
												<?php } ?>
											</ul>
										<?php } ?>
									<?php } ?>
								</div><!-- post content -->
							</div><!-- box -->
						</div><!-- box wrap -->
					</article><!-- post-->