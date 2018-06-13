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
			'footer-menu1' => esc_html__( 'Footer_Menu_1', 'blackowned' ),
			'footer-menu2' => esc_html__( 'Foot_Menu_2', 'blackowned' )
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
			'height'      => 156,
			'width'       => 500,
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

	wp_enqueue_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );

	wp_enqueue_style( 'blackowned-style', get_stylesheet_uri() );

	/**
	 * For enqueues of scripts
	 */
	wp_enqueue_script( 'bootstrapjs', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array( 'jQuery' ), 'all', true );
	
	wp_enqueue_script( 'blackowned-navigation', str_replace( array( 'http:', 'https:' ), '', get_template_directory_uri() . '/js/navigation.js' ), array(), '20151215', true );

	wp_enqueue_script( 'blackowned-skip-link-focus-fix', str_replace( array( 'http:', 'https:' ), '', get_template_directory_uri() . '/js/skip-link-focus-fix.js' ), array(), '20151215', true );

	wp_enqueue_script( 'blackowned-js', str_replace( array( 'http:', 'https:' ), '', get_template_directory_uri() . '/assets/js/blackowned.min.js' ), array(), 'all', true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'blackowned_scripts' );

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
 * Register Testimonial Post Type
 * @since 1.0.0 [<init>]
 */
function testimonials_post_type() {
	require get_template_directory() . '/inc/register-testimonials.php';
}
add_action( 'init', 'testimonials_post_type', 0 );