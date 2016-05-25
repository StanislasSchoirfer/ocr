<?php
/**
 * ocr_wp functions and definitions
 *
 * @package ocr_wp
 */

/**
* manage dependecies for this pck
**/

/************** TGM  *******************/

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/library/tgm/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );

function my_theme_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// SOIL
		array(
			'name'               => 'Soil', // The plugin name.
			'slug'               => 'soil-master', // The plugin slug (typically the folder name).
			'source'             => get_stylesheet_directory() . '/library/plugins/soil-master.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),

		// META BOX
		array(
			'name'      => 'meta-box',
			'slug'      => 'meta-box',
			'required'  => true,
		),

		

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.


	);

	tgmpa( $plugins, $config );
}
/************** /TGM  ******************/


if ( ! function_exists( 'ocr_wp_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ocr_wp_setup() {

	/**
	* Set the content width based on the theme's design and stylesheet.
	*/
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 640; /* pixels */
	}

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on ocr_wp, use a find and replace
	 * to change 'ocr_wp' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'ocr_wp', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	//Suport for WordPress 4.1+ to display titles
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'ocr_wp' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	// add_theme_support( 'post-formats', array(
	// 	'aside', 'image', 'video', 'quote', 'link',
	// ) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'ocr_wp_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	
	
	add_image_size( 'card-size', 1000, 300, array( 'center', 'center' ) );
	add_image_size( 'card-small', 800, 200, array( 'center', 'center' ) );
	add_image_size('activity-small', 200, 150, array('center', 'center') );
}
endif; // ocr_wp_setup
add_action( 'after_setup_theme', 'ocr_wp_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function ocr_wp_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'ocr_wp' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="panel panel-warning">',
		'after_widget'  => '</div></aside>',
		'before_title'  => ' <div class="panel-heading"><h3 class="panel-title">',
		'after_title'   => '</h3></div>',
	) );
	
	register_sidebar( array(
		'name' => 'Footer Sidebar 1',
		'id' => 'footer-sidebar-1',
		'description' => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
) );
}
add_action( 'widgets_init', 'ocr_wp_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
 add_action( 'wp_enqueue_scripts', 'register_jquery' );
function register_jquery() {
    if (!is_admin() && $GLOBALS['pagenow'] != 'wp-login.php') {
        // comment out the next two lines to load the local copy of jQuery
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js', false, '2.2.3');
        wp_enqueue_script('jquery');
    }
}
 
 
function ocr_wp_scripts() {
	wp_enqueue_style( 'ocr-bootstrap-styles', get_template_directory_uri() . '/bower_components/bootstrap/css/bootstrap-flex.min.css', array(), '4.a2', 'all' );

	wp_enqueue_style( 'ocr-roboto-styles', get_template_directory_uri() . '/bower_components/bmd/dist/css/roboto.min.css', array(), '', 'all' );

	// wp_enqueue_style( 'ocr-material-styles', get_template_directory_uri() . '/bower_components/bmd/dist/css/material-fullpalette.min.css', array(), '', 'all' );

	wp_enqueue_style( 'ocr-ripples-styles', get_template_directory_uri() . '/bower_components/bmd/dist/css/ripples.min.css', array(), '', 'all' );

	wp_enqueue_style( 'ocr_wp-style', get_stylesheet_uri() );

	wp_enqueue_script( 'ocr-bootstrap-js', get_template_directory_uri() . '/bower_components/bootstrap/dist/js/bootstrap.min.js', array('jquery', 'theter'), '4.a2', true );
	
	wp_enqueue_script('theter', "//cdnjs.cloudflare.com/ajax/libs/tether/1.3.1/js/tether.min.js", array('jquery'), '1.3.1', true);

	wp_enqueue_script( 'ocr-ripples-js', get_template_directory_uri() . '/bower_components/bmd/dist/js/ripples.min.js', array('jquery'), '', true );

	// wp_enqueue_script( 'ocr-material-js', get_template_directory_uri() . '/bower_components/bmd/dist/js/material.min.js', array('jquery'), '', true );

	wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/main.js', array('jquery'), '', true );


	//conditional load
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	if( is_post_type_archive( 'activite_cpt' ) ){
	
  		wp_enqueue_script('modal-script',get_template_directory_uri() . '/js/activite_modal.js',	array('jquery', 'ocr-bootstrap-js'), '1', true	);
	}
	
	
}
add_action( 'wp_enqueue_scripts', 'ocr_wp_scripts' );


//remove hard width and height
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}



// Adding search field in the primary nav bar

add_filter('wp_nav_menu_items','add_search_box_to_menu', 10, 2);
function add_search_box_to_menu( $items, $args ) {

	if( 'primary' === $args -> theme_location ) {
	
   	$items .= '<li class="menu-item menu-item-search">';
	$items .= '<form method="get" class="form-inline pull-xs-right" role="search" action="' . get_bloginfo('url') . '/">';
	$items .= '<input class="form-control form-control-sm " type="text" placeholder="Rechercher" name="s" id="s"  />';
	$items .= '<button class="btn btn-danger-outline btn-sm " type="submit">Rechercher</button>';
	$items .= '</form>';
	$items .= '</li>';
	}
	
	
    return $items;
}


/* create an option page to set email receiver from our archive-activite_ctp form */

//remove hard size in the_post_thumbnail
function remove_img_attr ($html) {
    return preg_replace('/(width|height)="\d+"\s/', "", $html);
}

add_filter( 'post_thumbnail_html', 'remove_img_attr' );


//the_excerpt

function excerpt_ellipse($text) {
   return str_replace('[...]', ' <a href="'.get_permalink().'">Continuer la lecture...</a>', $text);
}
add_filter('get_the_excerpt', 'excerpt_ellipse');


/** 
*Custom email for activities registration.
*/
require get_template_directory() . '/inc/admin-email.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**


 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Adds a Walker class for the Bootstrap Navbar.
 */
require get_template_directory() . '/inc/bootstrap-walker.php';

/**
* Add bootstrap pagination 
*/
require get_template_directory() . '/inc/bootstrap-pagination.php';

/**
 * Comments Callback.
 */
require get_template_directory() . '/inc/comments-callback.php';