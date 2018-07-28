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

