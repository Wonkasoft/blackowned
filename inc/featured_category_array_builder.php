<?php
/**
 * Black Owned functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @since  1.0.0 init
 * @package blackowned
 */

$featured_image_1 =  ( ! get_theme_mod( 'featured_image_1' ) ) ? '' : get_theme_mod( 'featured_image_1' );
$featured_image_2 =  ( ! get_theme_mod( 'featured_image_2' ) ) ? '' : get_theme_mod( 'featured_image_2' );
$featured_image_3 =  ( ! get_theme_mod( 'featured_image_3' ) ) ? '' : get_theme_mod( 'featured_image_3' );

$featured_image_array = array(
	'featured_image_1' 	=> $featured_image_1, 
	'featured_image_2' 	=> $featured_image_2, 
	'featured_image_3' 	=> $featured_image_3, 
);


$array = array_filter( $featured_image_array );