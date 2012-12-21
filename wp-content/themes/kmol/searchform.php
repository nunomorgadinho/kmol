<?php
/**
 * The template for displaying search forms in kmol
 *
 * @package kmol
 * @since kmol 1.0
 */
?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<label for="s" class="assistive-text"><?php _e( 'Pesquisar', 'kmol' ); ?></label>
		<input type="text" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php _e( 'Pesquisar &hellip;', 'kmol' ); ?>" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php _e( 'Pesquisar', 'kmol' ); ?>" />
	</form>
