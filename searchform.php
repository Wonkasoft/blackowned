<?php
/**
 * Black Owned functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @since  1.0.0 [<init>]
 * @package blackowned
 */
?>
<form action="<?php echo home_url( '/' ); ?>" method="get">
	<div class="search-input-wrap">
    <label for="s" class="sr-only">Search</label>
    <input type="text" name="s" id="s" class="search-slide" placeholder="<?php esc_attr_e( 'Search...', 'blackowned' ); ?>" value="<?php the_search_query(); ?>" />
	<i id="search-btn" class="fa fa-search"></i>
	</div>
</form>