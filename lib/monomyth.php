<?php
/*
* This file initialises all the libraries included in the theme and does all the basic setup that are needed. 
*
*
*/

//enqueue required basic scripts and styles -- bootstrap css, js and app and js
//if ( !defined('MM_PRODUCTION') )
//	define('MM_PRODUCTION', false);
	
// clean ups taken from roots and bones theme framework

require( 'clean-up.php' ); 
require( 'nice-search.php' ); 
require( 'relative-urls.php' ); 
require( 'admin-cleanup.php' ); 
require( 'class-tgm-plugin-activation.php' ); 


// launching this stuff after theme setup
add_action( 'after_setup_theme','monomyth_theme_support' );

function monomyth_theme_support(){

	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'jquery-cdn' );
	add_theme_support( 'title-tag' );
	/* Adds core WordPress HTML5 support. */
	add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );
	/* Make text widgets shortcode aware. */
	add_filter( 'widget_text', 'do_shortcode' );

	/* Don't strip tags on single post titles. */
	remove_filter( 'single_post_title', 'strip_tags' );

	// wp menus
	add_theme_support( 'menus' );
	
	global $monomyth_options;
	$MM_PRODUCTION = false;
	if(isset($monomyth_options['dev_mode']))
		$MM_PRODUCTION = $monomyth_options['dev_mode'];
	
    if($MM_PRODUCTION) {
		add_filter('acf/settings/show_admin','__return_false');
	}
	
	// Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
	register_nav_menus(array(
		'primary_navigation' => __('Primary Navigation', 'monomyth'),
	));

}

function monomyth_widgets_init() {
  // Sidebars
  register_sidebar(array(
    'name'          => __('Primary', 'monomyth'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ));

  register_sidebar(array(
    'name'          => __('Footer', 'monomyth'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ));

}
add_action('widgets_init', 'monomyth_widgets_init');

function monomyth_scripts() {
  global $wp_styles;
  global $wp_scripts;
  global $monomyth_options;


//	  wp_enqueue_style('monomyth_app', get_template_directory_uri() . '/assets/css-cache/monomyth_app.css', false, null);
	
	 //wp_enqueue_style('monomyth_app', get_template_directory_uri() . '/assets/app.less', false, null);
	
	 wp_enqueue_style('monomyth_ie', get_template_directory_uri() . '/assets/ie.css', false, null);
	 $wp_styles->add_data( 'monomyth_ie', 'conditional', 'lt IE 10' ); // add conditional wrapper around ie stylesheet
  // jQuery is loaded using the same method from HTML5 Boilerplate:
  // Grab Google CDN's latest jQuery with a protocol relative URL; fallback to local if offline
  // It's kept in the header instead of footer to avoid conflicts with plugins.
  if (!is_admin() && current_theme_supports('jquery-cdn')) {
    wp_deregister_script('jquery');
    //wp_register_script('jquery', 'https://cdn.loantap.in/jquery/1.11.3/jquery.min.js', array(), null, false);
    //wp_register_script('jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js', array(), null, false);
  }

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_enqueue_script('jquery');
  
  
}
add_action('wp_enqueue_scripts', 'monomyth_scripts', 100);




function add_filters($tags, $function) {
  foreach($tags as $tag) {
    add_filter($tag, $function);
  }
}

//--- theme activation ---
function monomyth_theme_activation_action(){

}
add_action('admin_init','monomyth_theme_activation_action');


function monomyth_less_path(){
	return get_template_directory().'/assets/css-cache';
}
add_filter('wp_less_cache_path','monomyth_less_path');


function monomyth_less_url(){
	return get_template_directory_uri().'/assets/css-cache';
}
add_filter('wp_less_cache_url','monomyth_less_url');

// Add thumbnail class to thumbnail links
function monomyth_add_class_attachment_link( $html ) {
    $postid = get_the_ID();
    $html = str_replace( '<a','<a class="thumbnail"',$html );
    return $html;
}
add_filter( 'wp_get_attachment_link', 'monomyth_add_class_attachment_link', 10, 1 );

add_filter( 'clean_url', function( $url )
{
    if(strpos( $url, 'bootstrap.min.js' )) {
		// Must be a ', not "!
		return "$url' defer='defer";
	}
	// not our file
    return $url;
}, 11, 1 );


add_action( 'tgmpa_register', 'monomyth_register_required_plugins' );

function monomyth_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => 'Awesome Enterprise',
			'slug'      => 'awesome-enterprise',
			'required'  => true,
			'version'  => '1.0.0',
		)

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
		'id'           => 'monomyth',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'monomyth-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'monomyth' ),
			'menu_title'                      => __( 'Install Plugins', 'monomyth' ),
			'installing'                      => __( 'Installing Plugin: %s', 'monomyth' ), // %s = plugin name.
			'oops'                            => __( 'Something went wrong with the plugin API.', 'monomyth' ),
			'notice_can_install_required'     => _n_noop(
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'monomyth'
			), // %1$s = plugin name(s).
			'notice_can_install_recommended'  => _n_noop(
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'monomyth'
			), // %1$s = plugin name(s).
			'notice_cannot_install'           => _n_noop(
				'Sorry, but you do not have the correct permissions to install the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to install the %1$s plugins.',
				'monomyth'
			), // %1$s = plugin name(s).
			'notice_ask_to_update'            => _n_noop(
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'monomyth'
			), // %1$s = plugin name(s).
			'notice_ask_to_update_maybe'      => _n_noop(
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'monomyth'
			), // %1$s = plugin name(s).
			'notice_cannot_update'            => _n_noop(
				'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
				'monomyth'
			), // %1$s = plugin name(s).
			'notice_can_activate_required'    => _n_noop(
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'monomyth'
			), // %1$s = plugin name(s).
			'notice_can_activate_recommended' => _n_noop(
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'monomyth'
			), // %1$s = plugin name(s).
			'notice_cannot_activate'          => _n_noop(
				'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
				'monomyth'
			), // %1$s = plugin name(s).
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'monomyth'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'monomyth'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'monomyth'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'monomyth' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'monomyth' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'monomyth' ),
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'monomyth' ),  // %1$s = plugin name(s).
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'monomyth' ),  // %1$s = plugin name(s).
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'monomyth' ), // %s = dashboard link.
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'monomyth' ),

			'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		),
		*/
	);

	tgmpa( $plugins, $config );
}