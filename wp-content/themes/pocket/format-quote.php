<?php

/**
 * Template for quote posts.
 *
 * @package Pocket
 * @since Pocket 1.0
 */
?>

					<article <?php post_class( 'post' ); ?>>
						<!-- Quote Post Format -->
						<div class="box-wrap">
							<div class="box">
								<div class="format-quote">
									<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'okay' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_content(); ?></a>
								</div>
							</div><!-- box -->
						</div><!-- box wrap -->
					</article><!-- post -->