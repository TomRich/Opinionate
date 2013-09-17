<?php
/**
 * The template for displaying search forms
 *
 * @package Pocket
 * @since Pocket 1.0
 */
?>

<form action="<?php echo home_url( '/' ); ?>" class="search-form clearfix">
	<fieldset>
		<input type="text" class="search-form-input text" name="s" />
		<input type="submit" value="<?php _e('Search','okay'); ?>" class="submit search-button" />
	</fieldset>
</form>