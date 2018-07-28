<?php
/**
 * This file is for ajax setup and requests.
 *
 * @since 1.0.0 
 * 
 */
if ( ! defined( 'ABSPATH' ) ) exit; //No Direct Access

add_action( 'wp_enqueue_scripts', 'blackowned_localized_script' );

function blackowned_localized_script() {

	if ( get_post()->post_name == 'why-sell-with-us' ) {
		wp_localize_script( 'blackowned-js', 'BO_AJAX', array(
			'security'	=>	wp_create_nonce( 'bo-security' ),
		) );
	}

}

add_action( 'wp_ajax_packages_get', 'vendor_package_select' );

function vendor_package_select() {

	$args = array(
		'post_type'	=>	'vendortype',
		'post_status '	=>	'publish',
	);

	$get_packages = new WP_Query( $args );

	$payment_page_url = get_wcmp_vendor_settings('vendor_registration', 'vendor', 'general');
	$payment_page_url = get_permalink( $payment_page_url );

	wp_send_json_error( 'not working right yet!' );

}