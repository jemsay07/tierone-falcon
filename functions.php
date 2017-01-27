<?php
if ( !defined( 'ABSPATH' ) ) :
	exit;
endif;

/**
* Tierone functions & definitions
*
* @link https://developer.wordpress.org/themes/basics/theme-functions/
*
* @package Tierone
*/

if( !function_exists( 'tierone_setup' ) ) :
/**
* Sets up theme defaults and registers support for various WordPress features
* 
* Note that this function is hooked into the after_setup_theme hook, which
* runs before the init hook. The init hook is too late for some features, such
* as indicating support for post thumbnails.
*/

	function tierone_setup(){
		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Tierone, use a find and replace
		 * to change 'tierone' to the name of your theme in all the template files.
		*/
		load_theme_textdomain( 'tierone', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		*Enable support for Post Thumbnails on posts and pages.
		*
		*@link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		*/
		add_theme_support( 'post-thumbnails' );
		
		/*
		* Crop Image Size
		*/
		add_image_size( 't-post-thumbnail-large', 750, 500, true );
		add_image_size( 't-post-thumbnail-featured', 600, 400, true );
		add_image_size( 't-post-thumbnail-module-top', 540, 360, true );
		add_image_size( 't-post-thumbnail-module-bottom', 360, 247, true );
		add_image_size( 't-post-thumbnail-medium', 370, 426, true );
		add_image_size( 't-post-thumbnail-module-block', 370, 250, true );
		add_image_size( 't-post-thumbnail-medium-small', 213, 142, true);
		add_image_size( 't-post-thumbnail-small', 160, 107, true );

        
        /*
        * Let WordPress manage the document title.
        * By adding theme support, we declare that this theme does not use a
        * hard-coded <title> tag in the document head, and expect WordPress to
        * provide it for us.
        */
		add_theme_support( 'title-tag' );

		/*
		* Add Custom Logo Support
		*/
		add_theme_support( 'custom-logo' );

		/*
		* This theme uses wp_nav_menu in one location
		*/
		register_nav_menus( array(
			'primary'	=> esc_html__( 'Primary Menu', 'tierone' ),
			'footer'	=> esc_html__( 'Footer Menu', 'tierone' )
		) );

		/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		) );

		/*
		* Enable support for Post Formats.
		* See https://developer.wordpress.org/themes/functionality/post-formats/
		*/
		add_theme_support( 'post-formats', array(
			'aside',
			'gallery',
			'quote',
			'image',
			'video'
		) );

		/*
		* Setup the WordPress core custom background feature.
		*/
		add_theme_support( 'custom-background', apply_filters( 'tierone_custom_background_cb', array(
			'default-color'	=> 'fafafa',
			'default-image' => ''
		) ) );
	}

endif;

add_action( 'after_setup_theme', 'tierone_setup' );


/**
* Enqueue Scripts And Style
*/

function tierone_scripts(){

	// Bootstrap Enqueue
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '3.3.7' );

	// Font-Awesome Enqueue
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/css/font-awesome.css', array(), '4.6.3' );

	// Dan-Awesome Enqueue
	wp_enqueue_style( 'danawesome', get_template_directory_uri() . '/css/dan-awesome.css', array(), '1.0.0' );

	// Font-Style
	wp_enqueue_style( 'noto-sans', '//fonts.googleapis.com/css?family=Noto+Sans:400,700' );

	// Default
	wp_enqueue_style( 'tierone', get_stylesheet_uri() );

	// Bootstrap Script
	wp_enqueue_script( 'bootstrap-script', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.7', true );

	// Custom Script
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.0.0', true );

	if( is_singular() && comments_open() &&  get_option( 'thread_comments' ) ){
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'tierone_scripts' );


/**
* Display a custom logo, linked to home
*/
function tierone_custom_logo(){
	if( function_exists( 'the_custom_logo' ) ){
		the_custom_logo();
	}
}



// Filter the output of logo to fix Googles Error about itemprop logo
function tierone_custom_logo_html() {
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $html = sprintf( '<a href="%1$s" class="custom-logo-link" rel="home">%2$s</a>',
            esc_url( home_url( '/' ) ),
            wp_get_attachment_image( $custom_logo_id, 'full', false, array(
                'class'    => 'custom-logo',
            ) )
        );
    return $html;   
}
add_filter( 'get_custom_logo', 'tierone_custom_logo_html' );



/**
* Customize the class of logo
*/
function change_logo_class($html){
	$html = str_replace( 'custom-logo-link' , 'navbar-brand', $html);
	return $html;
}
add_filter( 'get_custom_logo','change_logo_class' );


/**
* Menu
*/
function tierone_custom_menu(){
	wp_nav_menu( array(
		'theme_location' => 'primary',
		'menu' => 'main_nav', /* menu name */
		'menu_class' => 'nav navbar-nav',
		'container' => false, /* container class */
		'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth' => 2,
		'walker'	=> new wp_custom_menu_walker()
	) );
};


/**
* This function Contains All The styles that Will be Loaded in the Theme Header
*/
function tierone_initialize_header(){
	echo '<style type="text/css">';
		echo get_theme_mod( 'custom_style', '' );
	echo '</style>';
}
add_action( 'wp_head', 'tierone_initialize_header' );

function tierone_initialize_footer(){
	echo '<script>';
		echo get_theme_mod( 'custom_script', '' );
	echo '</script>';
}
add_action( 'wp_footer', 'tierone_initialize_footer' );
		
/**
* Do Shortcode
*/
add_filter( 'widget_text','do_shortcode' );

/**
* Comment Forms
*/
require get_template_directory() . '/comments-form.php';

/**
* Breadcurmbs
*/
require get_template_directory() . '/includes/breadcrumbs.php';

/**
* Template tags
*/
require get_template_directory() . '/includes/template-tags.php';

/**
* Custom Menu Walker
*/
require get_template_directory() . '/includes/wp_custom_walker.php';

/**
* Custom Customize
*/
require get_template_directory() . '/includes/customizer.php';

/**
* Widgets
*/
require get_template_directory() . '/includes/widgets/widgets.php';

/**
* Social Media
*/
require get_template_directory() . '/template-part/social-media.php';

/**
* Social Sharing
*/
require get_template_directory() . '/template-part/social-sharing.php';
