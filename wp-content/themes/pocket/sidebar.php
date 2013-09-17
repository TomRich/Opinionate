<?php
/**
 * The Sidebar containing the main widget areas in the footer.
 *
 * @package Pocket
 * @since Pocket 1.0
 */
?>

			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widgets') ) : else : ?>		
			<?php endif; ?>