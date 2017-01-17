<?php

/**
 * Set the default content width based on the theme's design and stylesheet.
 * This defaults to Bootstrap's Large devices breakpoint (large desktops, 1200px and up)
 * 
 * As far as I can tell, WordPress uses this when setting the width and height for embeded media (iframes, YouTube, etc.) that is inserted
 * into the content area of posts/pages.
 */
// $content_width = 1170; 


/**
 * @todo Document me.
 */
// $monk_default_media_ratio = 9/16; // Standard widescreen ratio.


/**
 *  Generally used to initialize theme settings/options.
 *  This is the first action hook available to themes, triggered immediately after the active theme's functions.php file is loaded. 
 *  At this stage, the current user is NOT yet authenticated. 
 */
function monk_setup(){
    global $content_width, $monk_default_media_ratio;

    /*
     * Define the default thumbnail size for this project. If left uncommented, the default size will be calculated based on the values of
     * $content_width and $monk_default_media_ratio.
     */
    // set_post_thumbnail_size($width, $height, $crop);

    /**
     * Additional image sizes
     */
    add_image_size('full-width', $content_width, round($content_width * $monk_default_media_ratio), true);
    // add_image_size($name, $width, $height, $crop);

    /**
     * Define menus for this project. If support for 'monk-default-nav-menu' is declared then the default nav menu 'primary' will also be set unless 
     * it is already defined below.
     */
    //register_nav_menus(array( /* define your menu locations here */ ));
    register_nav_menus([
        'primary'   => __('Menu Menu'),
        'secondary' => __('Footer Menu'),
        'social'    => __('Social Menu')
    ]);

	
}
add_action('after_setup_theme', "monk_setup");


/**
 * Typically used by plugins to initialize. The current user is ALREADY authenticated by this time. 
 */
function monk_init(){
    
    /** feature support for post types */
    
    /**
     * Add excerpt fields to pages
     */
    //add_post_type_support('page', 'excerpt'); 
    
}
add_action('init', 'monk_init');


/**
 * wp_enqueue_scripts is the proper hook to use when enqueuing items that are meant to appear on the front end.
 * Despite the name, it is used for enqueuing both scripts and styles.
 */
function monk_enqueue_assets(){
    
    if(WP_ENV === 'development') { // Add assets here that are only to be loaded in during development stage.
        
        
    }else{ // Add assets here that are only to be loaded in during production.
        
        
    }
    
    // Global assets can be placed here...
    
}
add_action('wp_enqueue_scripts', 'monk_enqueue_assets');


/**
 * @see https://www.advancedcustomfields.com/add-ons/options-page/
 */
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}


/** DEFINE SUPPORT FOR CORE WORDPRESS FEATURES **
 * This section is where we define support for features that we want to use for this project.
 */


/**
 * Add default posts and comments RSS feed links to head.
 */
add_theme_support( 'automatic-feed-links' );


/*
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 */
add_theme_support( 'title-tag' );


/*
 * Enable support for Post Thumbnails (aka. 'Feature Images' ).
 *
 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
 */
add_theme_support( 'post-thumbnails' );


/*
 * Enable support for Post Formats.
 *
 * See: https://codex.wordpress.org/Post_Formats
 */
add_theme_support( 'post-formats', array(
    //'aside', 
    //'image', 
    //'video', 
    //'quote', 
    //'link', 
    //'gallery', 
    //'status', 
    //'audio', 
    //'chat',
) );


/** DEFINE SUPPORT FOR MONK FEATURES **/

// Add support for Bootstrap's Thumbnail Component to galleries
add_theme_support( 'monk-bootstrap-gallery' );


/**
 * Enable cache-busting.
 * 
 * WARNING!: the required rewrite rules MUST BE IN PLACE in the .htaccess file!
 * 
 * If you're not using a build process to manage your filename version
 * revving, you might want to consider enabling the following theme support
 * to route all requests such as `/style.422.css` to `/style.css`.
 *
 * To understand why this is important and even a better solution than
 * using something like `*.css?ver=4.0.0`, please see:
 * http://www.stevesouders.com/blog/2008/08/23/revving-filenames-dont-use-querystring/
 */
add_theme_support( 'monk-cache-busting' );


/**
 * If declared, the theme will register sidebars with the ID 'sidebar'. More than one can be registered by passing the second argument.
 */
//add_theme_support('monk-sidebar-widgets', 1);


/**
 * If declared, the theme will register sidebars that are expected to be loaded in the site's footer.
 */
//add_theme_support('monk-footer-widgets',3);


/**
 * Let the theme automatically create a menu called, which will be given the name 'primary'.
 * If this is not declared then you'll have to define menus for this project yourself within the monk_setup() function below.
 */
add_theme_support("monk-default-nav-menu");


/**
 * 
 */
add_theme_support('monk-base-template');


/**
 * 
 */
add_theme_support('monk-email-encrypt');


/**
 * Coming soon...
 * Don't enable this, will probably break site!
 */
// add_theme_support('monk-page-hooks');


/** DEFINE SUPPORT FOR SOIL PLUGIN FEATURES **
 * NOTE: Some of these features are also included in Monk\Config
 */


/**
 * Cleaner WordPress markup
 */
add_theme_support('soil-clean-up');


/**
 * Disable asset versioning
 */
ON_MONK && add_theme_support('soil-disable-asset-versioning');


/**
 * Disable trackbacks
 */
add_theme_support('soil-disable-trackbacks');


/**
 * Google Analytics ([more info](https://github.com/roots/soil/wiki/Google-Analytics))
 *
 * This is probably never needed since the SEO plugin we usually use also provides this functionality
 * 
 */
//add_theme_support('soil-google-analytics', 'UA-XXXXX-Y');


/**
 * Load jQuery from the jQuery CDN
 * 
 * WARNING: Currently this is not compatible with monk3's Asset Component Manager and will cause jQuery (and subsequently all it's dependencies)
 * to fail to load altogether.
 */
//add_theme_support('soil-jquery-cdn');


/**
 * Move all JS to the footer
 */
// add_theme_support('soil-js-to-footer');


/**
 * Cleaner walker for navigation menus
 * 
 * Basically conforms WordPres' nav menu to Bootstrap's Navbar structure.
 */
add_theme_support('soil-nav-walker');


/**
 * Convert search results from `/?s=query` to `/search/query/
 */
add_theme_support('soil-nice-search');


/**
 * Root relative URLs
 * 
 * Creates relative URIs for images and links rather than absolute paths that contain the server name.
 */
add_theme_support('soil-relative-urls');



/** LOAD CORE INCLUDES **/
/**
 * For the most part you can ignore this section.
 */

foreach ( [
    'includes/utils',            // Utility & helper functions
    'includes/setup',            // Initial theme setup and constants
    'includes/router',           // Setup the Template Router API
    'includes/slider',           // Load Slider API class
    'includes/partial',          // Partial Manager Class
    'includes/assets',           // Asset component manager for wiring scripts, stylesheets and their dependencies.
    'includes/config',           // Configure theme functionality
    'includes/nav',              // Custom nav walkers
    'includes/forms',            // Custom overrides for popular form plugins
    'includes/galleries',        // Custom galleries
    'includes/template-tags',    // Arbitary template tags
    'includes/shortcodes'        // Theme shortcodes

] as $file) if(!locate_template("$file.php", true, true))

        trigger_error ( sprintf( __( 'Error locating %s.php for inclusion.'), $file ) , E_USER_ERROR);
