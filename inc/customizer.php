<?php
/**
 * Black Owned Theme Customizer
 *
 * @package blackowned
 * @since  1.0.0 [<init>]
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function blackowned_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) :
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'blackowned_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'blackowned_customize_partial_blogdescription',
		) );

	endif;

	/**
	 * Theme options 
	 * @since 1.0.0 [Theme options for the homepage]
	 */
	$wp_customize->add_panel( 'ft_theme_options', array(
		'priority'			=> 1,
		'capability' 		=> 'edit_theme_options',
		'theme_support' => '',
		'title' 				=> __( 'Theme Options', 'blackowned' ),
		'description'		=> __( 'Theme Settings', 'blackowned' )
		 ) );

	/**
	 * For Slide Image on home page
	 * @since 1.0.0 [Adding in Slide Image]
	 */
	$wp_customize->add_section( 'slide_section', array(
		'capability'		=> 'edit_theme_options',
		'theme_support'	=> '',
		'priority'			=> 11,
		'title'					=> __( 'Slide Section', 'blackowned' ),
		'description'		=> __( 'Slide Section Options', ' blackowned' ),
		'panel'					=> 'ft_theme_options' 
		) );

for ($i=1; $i < 5; $i++) :
	/**
	 * Headaing image setting
	 * @since 1.0.0 [Slide Image setings]
	 */
	$wp_customize->add_setting( 'slide_image_'.$i, array(
		'defualt'		=> '',
		'transport'	=> 'refresh'
		) );

	/**
	 * Control for main iamge
	 * @since 1.0.0 [Control for Slide Image]
	 */
	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize,
		'slide_image_'.$i, 
		array(
			'label' 			=> __( 'Slide Image', 'blackowned' ), 
			'section'			=> 'slide_section', 
			'setting'			=> 'slide_image_'.$i, 
			'type'				=> 'image',
			'description'	=> __( 'Recommended size: 1330 x 401 pixels', 'blackowned' )
		)
	) );
endfor;

		/**
	 * For Featured Image
	 * @since 1.0.0 [Adding in Testimonials Background Image]
	 */
	$wp_customize->add_section( 'featured_section', array(
		'capability'		=> 'edit_theme_options',
		'theme_support'	=> '',
		'priority'			=> 12,
		'title'					=> __( 'Featured Section', 'blackowned' ),
		'description'		=> __( 'Featured Section Options', ' blackowned' ),
		'panel'					=> 'ft_theme_options' 
		) );

for ($i=1; $i < 4 ; $i++) :
	/**
	 * Featured Image setting
	 * @since 1.0.0 [Featured Image setings]
	 */
	$wp_customize->add_setting( 'featured_image_'.$i, array(
		'defualt'		=> '',
		'transport'	=> 'refresh'
		) );

	/**
	 * Controller for Featured Image
	 * @since 1.0.0 [Control for Featured Image]
	 */
	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize,
		'featured_image_'.$i, 
		array(
			'label' 			=> __( 'Featured Image', 'blackowned' ), 
			'section'			=> 'featured_section', 
			'setting'			=> 'featured_image_'.$i, 
			'type'				=> 'image',
			'description'	=> __( 'Chose Featured Image '.$i, 'blackowned' )
		)
	) );
endfor;

	/**
	 * Follow us Section
	 * @since 1.0.0 [adding follow us section]
	 */
	$wp_customize->add_section( 'followus_section', array(
		'capability' 		=> 'edit_theme_options',
		'theme_support'	=> '',
		'priority'			=> 15,
		'title' 				=> __( 'Follow Us Section' , 'blackowned'),
		'description'		=> __( 'Follow Us Section Options', 'blackowned' ),
		'panel'					=> 'ft_theme_options'
	) );

	/**
	 * Shortcode for IG Setting
	 * @since  1.0.0 [<init>]
	 */
	$wp_customize->add_setting( 'ig_code', array(
		'default'	=> '',
		'refresh'	=> 'refresh'
	) );
	
	/**
	 * Shortcode for IG Control
	 * @since  1.0.0 [<init>]
	 */
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'ig_code',
		array(
		  'label' 			=> __( 'IG API', 'blackowned' ), 
			'section'			=> 'followus_section', 
			'setting'			=> 'ig_code', 
			'type'				=> 'text',
			'description'	=> __( 'Input Shortcode for IG', 'blackowned' )
		)
	) );

		/**
	 * Follow us Message for IG Setting
	 * @since  1.0.0 [<init>]
	 */
	$wp_customize->add_setting( 'follow_message', array(
		'default'	=> '',
		'refresh'	=> 'refresh'
	) );
	
	/**
	 * follow_message for IG Control
	 * @since  1.0.0 [<init>]
	 */
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'follow_message',
		array(
		  'label' 			=> __( 'Follow us message', 'blackowned' ), 
			'section'			=> 'followus_section', 
			'setting'			=> 'follow_message', 
			'type'				=> 'text',
			'description'	=> __( 'Input follow us message for IG', 'blackowned' )
		)
	) );

	/**
	 * Footer Section
	 * @since 1.0.0 [adding footer section]
	 */
	$wp_customize->add_section( 'footer_section', array(
		'capability' 		=> 'edit_theme_options',
		'theme_support'	=> '',
		'priority'			=> 15,
		'title' 				=> __( 'Footer Section' , 'blackowned'),
		'description'		=> __( 'Footer Section Options', 'blackowned' ),
		'panel'					=> 'ft_theme_options'
	) );

		/**
	 * Footer Logo settings
	 * @since 1.0.0
	 */
	$wp_customize->add_setting( 'footer_logo', array(
		'default'		=> '',
		'transport'	=> 'refresh'
	) );

	/**
	 * Footer Logo Controller
	 * @since 1.0.0
	 */
	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize,
		'footer_logo',
		array(
		  'label' 			=> __( 'Footer Logo', 'blackowned' ), 
			'section'			=> 'footer_section', 
			'setting'			=> 'footer_logo', 
			'image'				=> 'image',
			'description'	=> __( 'Select a Logo recommended size 300px x 150px ', 'blackowned' )
		)
	) );

	/**
	 * Footer copyright settings
	 * @since 1.0.0
	 */
	$wp_customize->add_setting( 'copyright', array(
		'default'		=> '',
		'transport'	=> 'refresh'
	) );

	/**
	 * Footer copyright Controller
	 * @since 1.0.0
	 */
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'copyright',
		array(
		    'label' 		=> __( 'Copyright Text', 'blackowned' ), 
			'section'			=> 'footer_section', 
			'setting'			=> 'copyright', 
			'type'				=> 'text',
			'description'	=> __( 'Input Copyright Information', 'blackowned' )
		)
	) );

	 /**
	 * Footer design credits settings
	 * @since 1.0.0
	 */
	$wp_customize->add_setting( 'design_credits', array(
		'default'		=> '',
		'transport'	=> 'refresh'
	) );

	/**
	 * Footer design credits Controller
	 * @since 1.0.0
	 */
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'design_credits',
		array(
		  'label' 			=> __( 'Design credit', 'blackowned' ), 
			'section'			=> 'footer_section', 
			'setting'			=> 'design_credits', 
			'type'				=> 'text',
			'description'	=> __( 'Input design credits text', 'blackowned' )
		)
	) );

	/**
	 * Social Section
	 * @since  1.0.0 [adding social settings]
	 */
	$wp_customize->add_section( 'social_section', array(
		'capability'    => 'edit_theme_options',
		'theme_support'	=> '',
		'priority' 		 	=> 16,
		'title' 		 		=> __( 'Social Section', 'blackowned'),
		'description' 	=> __( 'Input Social Links', 'blackowned'),
		'panel'			 		=> 'ft_theme_options'
	) );

		/**
	 * Social SnapChat Setting
	 * @since  1.0.0 [<init>]
	 */
		$wp_customize->add_setting( 'snapchat', array(
			'default'	=> '',
			'refresh'	=> 'refresh'
		) );

		/**
		 * Social SnapChat Control
		 * @since 1.0.0 [<init>]
		 */
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'snapchat',
			array(
			  'label' 			=> __( 'SnapChat', 'blackowned' ), 
				'section'			=> 'social_section', 
				'setting'			=> 'snapchat', 
				'type'				=> 'text',
				'description'	=> __( 'Input SnapChat Link', 'blackowned' )
			)
		) );

		/**
		 * Social Instagram Setting
		 * @since  1.0.0 [<init>]
		 */
		$wp_customize->add_setting( 'instagram', array(
			'default'	=> '',
			'refresh'	=> 'refresh'
		) );

		/**
		 * Social Instagram Control
		 * @since 1.0.0 [<init>]
		 */
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'instagram',
			array(
			  'label' 			=> __( 'Instagram', 'blackowned' ), 
				'section'			=> 'social_section', 
				'setting'			=> 'instagraml', 
				'type'				=> 'text',
				'description'	=> __( 'Input instagram Link', 'blackowned' )
			)
		) );

			/**
		 * Social Facebook Settings
		 * @since 1.0.0 [social settings]
		 */
		$wp_customize->add_setting( 'facebook', array(
			'default'	=> '',
			'refresh'	=> 'refresh'
		) );

		/**
		 * Social Facebook Control
		 * @since  1.0.0 [control for social links]
		 */
		$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'facebook',
			array(
			  'label' 			=> __( 'Facebook', 'blackowned' ), 
				'section'			=> 'social_section', 
				'setting'			=> 'facebook', 
				'type'				=> 'text',
				'description'	=> __( 'Input Facebook Link', 'blackowned' )
			)
		) );

	/**
	 * Social Twitter Setting
	 * @since  1.0.0 [<init>]
	 */
	$wp_customize->add_setting( 'twitter', array(
		'default'	=> '',
		'refresh'	=> 'refresh'
	) );
	
	/**
	 * Social Twitter Control
	 * @since  1.0.0 [<init>]
	 */
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'twitter',
		array(
		  'label' 			=> __( 'Twitter', 'blackowned' ), 
			'section'			=> 'social_section', 
			'setting'			=> 'twitter', 
			'type'				=> 'text',
			'description'	=> __( 'Input Twitter Link', 'blackowned' )
		)
	) );
	
	/**
 * Social Yelp Setting
 * @since  1.0.0 [<init>]
 */
	$wp_customize->add_setting( 'yelp', array(
		'default'	=> '',
		'refresh'	=> 'refresh'
	) );

	/**
	 * Social Yelp Control
	 * @since 1.0.0 [<init>]
	 */
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'yelp',
		array(
		  'label' 			=> __( 'Yelp', 'blackowned' ), 
			'section'			=> 'social_section', 
			'setting'			=> 'yelp', 
			'type'				=> 'text',
			'description'	=> __( 'Input Yelp Link', 'blackowned' )
		)
	) );

}
	
add_action( 'customize_register', 'blackowned_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function blackowned_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function blackowned_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function blackowned_customize_preview_js() {
	wp_enqueue_script( 'blackowned-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'blackowned_customize_preview_js' );