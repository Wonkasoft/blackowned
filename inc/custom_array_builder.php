<?php
/**
 * Black Owned functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @since  1.0.0 init
 * @package blackowned
 */

$array_type = trim( $array_type, " " );
$array_good = false;

if ( $array_type == 'featured-array') {
	$array_good = true;
	$featured_image_1 =  ( ! get_theme_mod( 'featured_image_1' ) ) ? '' : get_theme_mod( 'featured_image_1' );
	$featured_image_2 =  ( ! get_theme_mod( 'featured_image_2' ) ) ? '' : get_theme_mod( 'featured_image_2' );
	$featured_image_3 =  ( ! get_theme_mod( 'featured_image_3' ) ) ? '' : get_theme_mod( 'featured_image_3' );

	$featured_image_array = array(
		'featured_image_1' 	=> $featured_image_1, 
		'featured_image_2' 	=> $featured_image_2, 
		'featured_image_3' 	=> $featured_image_3, 
	);


	$array = array_filter( $featured_image_array );
}

if ( $array_type == 'slider-array') {
	$array_good = true;
	$slide_image_1 =  ( ! get_theme_mod( 'slide_image_1' ) ) ? '' : get_theme_mod( 'slide_image_1' );
	$slide_image_2 =  ( ! get_theme_mod( 'slide_image_2' ) ) ? '' : get_theme_mod( 'slide_image_2' );
	$slide_image_3 =  ( ! get_theme_mod( 'slide_image_3' ) ) ? '' : get_theme_mod( 'slide_image_3' );
	$slide_image_4 =  ( ! get_theme_mod( 'slide_image_4' ) ) ? '' : get_theme_mod( 'slide_image_4' );

	$featured_image_array = array(
		'slide_image_1' 	=> $slide_image_1,
		'slide_image_2' 	=> $slide_image_2,
		'slide_image_3' 	=> $slide_image_3,
		'slide_image_4' 	=> $slide_image_4,
	);


	$array = array_filter( $featured_image_array );
}