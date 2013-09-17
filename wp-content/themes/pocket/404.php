<?php

/**
 * 404 Error Page
 *
 * @package Pocket
 * @since Pocket 1.0
 */
?>

<?php get_header(); ?>

	<div id="content">
		<div class="posts">
			<!-- titles -->
			<h2 class="archive-title"><i class="icon-warning-sign"></i> <?php _e( '404', 'okay' ); ?></h2>

			<!-- grab the posts -->
			<article class="post">
				<div class="box-wrap">
					<div class="box">
						<header class="post-header">
							<div class="date-title"></div>
							<h1 class="entry-title">
								<?php _e( 'Page Not Found', 'okay' ); ?>
							</h1>
						</header>

						<!-- post content -->
						<div class="post-content">
							<p><?php _e( 'Sorry, but the page you are looking for has moved or no longer exists. Please use the search below, or the menu above to locate the missing page.', 'okay' ); ?></p>

							<?php get_search_form(); ?>
						</div>
						<!-- post content -->
					</div>
					<!-- box -->
				</div>
				<!-- box wrap -->
			</article>
			<!-- post-->
		</div>
	</div><!-- content -->

	<!-- footer -->
<?php get_footer(); ?>