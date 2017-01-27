<?php
/**
* Tierone Customizer
*
* @package tierone
*/

function tierone_customize_register( $wp_customize ){

	$wp_customize->get_setting( 'blogname' )->transport = ' postMessage ';
	$wp_customize->get_setting( 'blogdescription' )->transport = ' postMessage ';
	$wp_customize->get_setting( 'header_textcolor' )->transport = ' postMessage ';

	//Header Settings
	$wp_customize->add_panel(
		'tierone_header_options',
		array(
			'priority' => 200,
			'title' => __( 'Header Settings', 'tierone' ),
			'description' => __( 'Use this to setup header settings','tierone' ),
			'capability' => 'edit_theme_options'
		)
	);

	//Layout and Content
	$wp_customize->add_panel( 'tierone_layout_options', array(
		'priority' => 201,
		'title' => __( 'Layout and Content', 'tierone' ),
		'description' => __( 'Layout and Content Settings', 'tierone' ),
		'capability' => 'edit_theme_options'
	) );

	//Related Post
	$wp_customize->add_section( 'tierone_related_post_section', array(
		'title' => __( 'Related Posts', 'tierone' ),
		'priority' => 1,
		'panel' => 'tierone_layout_options'
	) );
	$wp_customize->add_setting( 'tierone_related_post_setting', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'tierone_checkbox_sanitize'
	) );
	$wp_customize->add_control( 'tierone_related_post', array(
		'type' => 'checkbox',
		'label' => __( 'Check to activate the related posts', 'tierone' ),
		'section' => 'tierone_related_post_section',
		'settings' => 'tierone_related_post_setting'
	) );

	//Social Sharing
	$wp_customize->add_section( 'tierone_social_sharing_section', array(
		'title' => __( 'Social Sharing', 'tierone' ),
		'priority' => 2,
		'panel' => 'tierone_layout_options'
	) );
	$wp_customize->add_setting( 'tierone_social_sharing_setting', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'tierone_checkbox_sanitize'
	) );
	$wp_customize->add_control( 'tierone_social_sharing', array(
		'type' => 'checkbox',
		'label' => __( 'Check to activate the social sharing in the article', 'tierone' ),
		'section' => 'tierone_social_sharing_section',
		'settings' => 'tierone_social_sharing_setting'
	) );

	//Social Media
	$wp_customize->add_section( 'tierone_social_media_section', array(
		'title' 	=> __( 'Social Media', 'tierone' ),
		'priority'  => 34
	) );

	//Display on Top
	$wp_customize->add_setting( 'display_social_media_top', array(
		'default' => 0,
		'sanitize_callback' => 'tierone_checkbox_sanitize'
	) );
	$wp_customize->add_control( 'display_social_media_top', array(
		'type' 	=> 'checkbox',
		'label' => __( 'Diplay Social Media on the top', 'tierone' ),		
		'section' => 'tierone_social_media_section',
		'settings' => 'display_social_media_top'
	) );

	//Display on Bottom
	$wp_customize->add_setting( 'display_social_media_bottom', array(
		'default' => 0,
		'sanitize_callback' => 'tierone_checkbox_sanitize'
	) );
	$wp_customize->add_control( 'display_social_media_bottom', array(
		'type' 	=> 'checkbox',
		'label' => 'Diplay Social Media on the bottom',
		'section' => 'tierone_social_media_section',
		'settings' => 'display_social_media_bottom'
	) );


	//facebook
	$wp_customize->add_setting( 'facebook_url', array(
		'default' => '',
		'sanitize_callback' => 'tierone_sanitize_url'
	) );
	$wp_customize->add_control( 'facebook_url', array(
		'type' => 'url',
		'label' => __( 'Facebook URL', 'tierone' ),
		'section' => 'tierone_social_media_section',
		'settings' => 'facebook_url'
	) );

	//twitter
	$wp_customize->add_setting( 'twitter_url', array(
		'default' => '',
		'sanitize_callback' => 'tierone_sanitize_url'
	) );
	$wp_customize->add_control( 'twitter_url', array(
		'type' => 'url',
		'label' => __( 'Twitter URL', 'tierone' ),
		'section' => 'tierone_social_media_section',
		'settings' => 'twitter_url'
	) );

	//pinterest
	$wp_customize->add_setting( 'pinterest_url', array(
		'default' => '',
		'sanitize_callback' => 'tierone_sanitize_url'
	) );
	$wp_customize->add_control( 'pinterest_url', array(
		'type' => 'url',
		'label' => __( 'Pinterest URL', 'tierone' ),
		'section' => 'tierone_social_media_section',
		'settings' => 'pinterest_url'
	) );

	//google plus
	$wp_customize->add_setting( 'google_plus_url', array(
		'default' => '',
		'sanitize_callback' => 'tierone_sanitize_url'
	) );
	$wp_customize->add_control( 'google_plus_url', array(
		'type' => 'url',
		'label' => __( 'Google Plus URL', 'tierone' ),
		'section' => 'tierone_social_media_section',
		'settings' => 'google_plus_url'
	) );

	//youtube
	$wp_customize->add_setting( 'youtube_url', array(
		'default' => '',
		'sanitize_callback' => 'tierone_sanitize_url'
	) );
	$wp_customize->add_control( 'youtube_url', array(
		'type' => 'url',
		'label' => __( 'Youtube URL', 'tierone' ),
		'section' => 'tierone_social_media_section',
		'settings' => 'youtube_url'
	) );

	//linkedin
	$wp_customize->add_setting( 'linkedin_url', array(
		'default' => '',
		'sanitize_callback' => 'tierone_sanitize_url'
	) );
	$wp_customize->add_control( 'linkedin_url', array(
		'type' => 'url',
		'label' => __( 'Linkedin URL', 'tierone' ),
		'section' => 'tierone_social_media_section',
		'settings' => 'linkedin_url'
	) );

	//HTML Editor
	$wp_customize->add_section( 'tierone_editor', array(
		'title' 	=> __( 'HTML Editor', 'tierone' ),
		'priority' => 35,
	) );

	//Meta Tags
	$wp_customize->add_setting( 'custom_meta', array(
		'default' => '',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options'
	));
	$wp_customize->add_control( 'custom_meta', array(
		'settings' 	=> 'custom_meta',
		'section'	=> 'tierone_editor',
		'type' 		=> 'textarea',
		'label'		=> __( 'Custom Meta', 'tierone' ),
		'description' => __( 'Customize meta tags for seo', 'tierone' )
	) );

	//HTML Editor
	$wp_customize->add_setting( 'custom_editor', array(
		'default' => ''
	) );
	$wp_customize->add_control( 'custom_editor', array(
		'settings'	=> 'custom_editor',
		'section'	=> 'tierone_editor',
		'type'		=> 'textarea',
		'label'		=> __( 'HTML Editor', 'tierone' ),
		'description' => __( 'Customize your html', 'tierone' )
	) );

	//Footer Editor
	$wp_customize->add_setting( 'footer_editor', array(
		'default' => '&copy; TIER. Blogsite Theme by Niel Rosini'
	) );
	$wp_customize->add_control( 'footer_editor', array(
		'settings'	=> 'footer_editor',
		'section'	=> 'tierone_editor',
		'type'		=> 'textarea',
		'label'		=> __( 'Footer Editor', 'tierone' ),
		'description' => __( 'Customize your footer', 'tierone' )
	) );

	//CSS Editor
	$wp_customize->add_setting( 'custom_style', array(
		'default' => '',
		'type' => 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'tierone_sanitize_css'
	) );
	$wp_customize->add_control( 'custom_style', array(
		'settings'	=> 'custom_style',
		'section'	=> 'tierone_editor',
		'type'		=> 'textarea',
		'label'		=> __( 'CSS Editor', 'tierone' ),
		'description' => __( 'Customize your css', 'tierone' )
	) );

	//Javascript Editor
	$wp_customize->add_setting( 'custom_script', array(
		'default' => '',
		'type' => 'theme_mod',
		'capability'		=> 'edit_theme_options'
	) );
	$wp_customize->add_control( 'custom_script', array(
		'settings'	=> 'custom_script',
		'section'	=> 'tierone_editor',
		'type'		=> 'textarea',
		'label'		=> __( 'Script Editor', 'tierone' ),
		'description' => __( 'Customize your script', 'tierone' )
	) );


	//sanitize url
	function tierone_sanitize_url( $url ){
		return esc_url_raw( $url );
	}

	//checkbox sanitize
	function tierone_checkbox_sanitize( $input ){
		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}
	}

	//Color Sanitize
	function tierone_color_sanitize( $color ){

		if( $unhashed = sanitize_hex_color_no_hash( $color ) ){
			return '#' . $unhashed;
		}
		return $color;
	}

	// Color Escape Sanitize
	function tierone_color_escaping_sanitize( $input ){
		$input = esc_attr( $input );
		return $input;
	}

	
	//Number Integer
	
	function tierone_sanitize_integer( $input ) {
		return absint( $input );
	}

	//HTML Sanitize
	function tierone_sanitize_html( $html ) {
		return wp_filter_post_kses( $html );
	}

	//custom css
	function tierone_sanitize_css( $css ) {
		return wp_strip_all_tags( $css );
	}

}
add_action( 'customize_register', 'tierone_customize_register' );


function tierone_customise_prev_js(){
	wp_enqueue_script( 'tierone_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20161102', true );
}
add_action( 'wp_enqueue_scripts', 'tierone_customise_prev_js' );
?>