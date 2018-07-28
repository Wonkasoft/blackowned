<?php
/**
 * Black Owned functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @since  1.0.0 [<init>]
 * @package blackowned
 */

if ( ! function_exists( 'blackowned_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function blackowned_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Black Owned, use a find and replace
		 * to change 'blackowned' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'blackowned', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'blackowned' ),
			'footer-menu1' => esc_html__( 'Categories', 'blackowned' ),
			'footer-menu2' => esc_html__( 'Info', 'blackowned' ),
			'footer-menu3' => esc_html__( 'Services', 'blackowned' )
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'blackowned_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 290,
			'width'       => 480,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		/**
		 * Add Gravity form support
		 * Hide gform field labels
		 * @since  1.0.0 [<init>]
		 */
		add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );
	}
endif;
add_action( 'after_setup_theme', 'blackowned_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blackowned_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'blackowned_content_width', 640 );
}
add_action( 'after_setup_theme', 'blackowned_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function blackowned_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'blackowned' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'blackowned' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Categories', 'blackowned' ),
		'id'            => 'categories',
		'description'   => esc_html__( 'Add widgets here.', 'blackowned' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'blackowned_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function blackowned_scripts() {
	/**
	 * For enqueues of stylesheets
	 */
	wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' );

	wp_enqueue_style( 'bootstrap-toggle', 'https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css' );

	wp_enqueue_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );

	wp_enqueue_style( 'blackowned-style', get_stylesheet_uri() );

	/**
	 * For enqueues of scripts
	 */
	wp_enqueue_script( 'bootstrapjs', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array( 'jquery' ), 'all', true );

	wp_enqueue_script( 'bootstrapjs-toggle', 'https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js', array(), 'all', true );
	
	wp_enqueue_script( 'blackowned-navigation', str_replace( array( 'http:', 'https:' ), '', get_template_directory_uri() . '/js/navigation.js' ), array(), '20151215', true );

	wp_enqueue_script( 'blackowned-skip-link-focus-fix', str_replace( array( 'http:', 'https:' ), '', get_template_directory_uri() . '/js/skip-link-focus-fix.js' ), array(), '20151215', true );

	wp_enqueue_script( 'blackowned-js', str_replace( array( 'http:', 'https:' ), '', get_template_directory_uri() . '/assets/js/blackowned.min.js' ), array(), 'all', true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'blackowned_scripts' );

 
function boupdate_cart_count_fragments( $fragments ) {
    	$fragments['span.header-cart-count'] = '<span class="badge badge-dark header-cart-count">' . WC()->cart->get_cart_contents_count() . '</span>';
    return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'boupdate_cart_count_fragments', 10, 1 );



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Ajax additions.
 */
require get_template_directory() . '/inc/blackowned-ajax.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * custom_arrays_function | This function is to build an array from the customizer sections from this theme.
 * @param  string | $array_type | string should be set as featured-array or slider-array
 * @return array | This array is build from the featured section or slider section in the customizer
 */
function custom_arrays_function( $array_type ) {
	require get_template_directory() . '/inc/custom_array_builder.php';
	if ( count( $array ) == 0 || !$array_good ) :
		return false;
	endif;
	return $array;
}

add_action( 'wp_ajax_packages_get', 'vendor_package_select' );
add_action( 'wp_ajax_nopriv_packages_get', 'vendor_package_select' );

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
		$output .= array('payment_url' => $payment_url, 'ID' => $package->ID, 'post_name' => $package->post_name, );
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