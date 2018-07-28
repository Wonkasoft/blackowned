<?php
/**
 * This file is for ajax setup and requests.
 *
 * @since 1.0.0 
 * 
 */
if ( ! defined( 'ABSPATH' ) ) exit; //No Direct Access

function vendor_package_select() {

	if ( ! check_ajax_referer( 'bo-security', 'security' ) ) {
		return wp_send_json_error( 'Invalid Nonce' );
	}

	global $WCMP_Vendor_Membership, $WCMp;
	$global_settings = $WCMP_Vendor_Membership->get_global_settings();
	$user_is_admin = false;
	$current_user = wp_get_current_user();
	
	if ( function_exists( 'is_user_wcmp_vendor' )) {
	    $is_vendor = is_user_wcmp_vendor( $current_user );
	} elseif ( function_exists( 'is_user_wcmp_pending_vendor' ) ) {
	    $is_pending_vendor = is_user_wcmp_pending_vendor( $current_user );
	}

	$args = array(
		'post_type'	=>	'vendortype',
		'post_status'	=> 'publish',
	);

	$get_packages = new WP_Query( $args );

	$payment_page_url = get_wcmp_vendor_settings( 'vendor_registration', 'vendor', 'general' );
	$payment_page_url = get_permalink( $payment_page_url );

	$output = [];

	foreach ( $get_packages->posts as $package ) {
		array_push( $output, array( 'package' => array('payment_url' => $payment_page_url, 'ID' => $package->ID, 'post_name' => $package->post_name ) ) );
	}

	$json_obj = json_encode( $output );
	$json_obj = json_decode( $json_obj );

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


	array_push( $output, array( 'btn_text' => $btn_text ) );

	return wp_send_json_success( $output );
}

add_action( 'wp_ajax_packages_get', 'vendor_package_select' );
add_action( 'wp_ajax_nopriv_packages_get', 'vendor_package_select' );