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

	if ( ! check_ajax_referer( 'bo-security', 'security' ) ) {
		return wp_send_json_error( 'Invalid Nonce' );
	}
	
	$user_is_admin = false;
	$current_user = wp_get_current_user();
	
	if ( function_exists( 'is_user_wcmp_vendor' )) {
	    $is_vendor = is_user_wcmp_vendor( $current_user );
	} elseif ( function_exists( 'is_user_wcmp_pending_vendor' ) ) {
	    $is_pending_vendor = is_user_wcmp_pending_vendor( $current_user );
	}

	$args = array(
		'post_type'	=>	'vendortype',
		'post_status '	=>	'publish',
	);

	$get_packages = new WP_Query( $args );

	$payment_page_url = get_wcmp_vendor_settings( 'vendor_registration', 'vendor', 'general' );
	$payment_page_url = get_permalink( $payment_page_url );
	$output = [];

	foreach ( $get_packages as $package ) {
		if ( $package->post_name == $_POST['package'] ) {
			$output .= array('payment_url' => $payment_url, 'ID' => $package->ID, 'post_name' => $package->post_name, );
			break;
		}
	}

	$json_obj = json_encode( $output );
	$json_obj = json_encode( $json_obj );

	$_vendor_billing_field = get_post_meta( $json_obj->ID, '_vendor_billing_field', true );

	$btn_text = __( 'Subscribe Now', 'wcmp-vendor_membership' );
	if ( isset( $_vendor_billing_field['_subscribe_button_text'] ) && $_vendor_billing_field['_subscribe_button_text'] != '' ) {
	    $btn_text = $_vendor_billing_field['_subscribe_button_text'];
	}
	if ($current_user->ID != 0) {
	    $btn_text = __( 'Upgrade Now', 'wcmp-vendor_membership' );
	    if ( isset( $_vendor_billing_field['_subscribe_button_text_logged_in'] ) && $_vendor_billing_field['_subscribe_button_text_logged_in'] != '' ) {
	        $btn_text = $_vendor_billing_field['_subscribe_button_text_logged_in'];
	    }
	}
	if ( isset( $is_vendor ) && $is_vendor != 0 && $is_vendor != '' && $is_vendor != false ) {

	    $btn_text = __( 'Upgrade Now', 'wcmp-vendor_membership' );
	    if ( isset( $_vendor_billing_field['_subscribe_button_text_upgrade'] ) && $_vendor_billing_field['_subscribe_button_text_upgrade'] != '' ) {
	        $btn_text = $_vendor_billing_field['_subscribe_button_text_upgrade'];
	    }
	}
	if ( current_user_can( 'manage_options' ) ) {
		$user_is_admin = true;
		$btn_text = __( 'Sorry you are logged in as admin please try with another account or logoff', 'blackowned' );
	}

	$output = array_push( $output, array( 'btn_text' => $btn_text ) );
	$output = json_encode( $output );
	$output = json_decode( $output );

	return $output;
}