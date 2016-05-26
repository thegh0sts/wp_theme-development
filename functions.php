<?php
/**
 * Dev-theme functions and definitions
 *
 * @package Dev-theme
 * @since Dev-theme 1.0
 */
 
 /**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Dev-theme 1.0
 */

if ( ! function_exists( 'devtheme_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Dev-theme 1.0
 */
function devtheme_setup() {
 
    /**
     * Custom template tags for this theme.
     */
    require( get_template_directory() . '/inc/template-tags.php' );
 
    /**
     * Custom functions that act independently of the theme templates
     */
    require( get_template_directory() . '/inc/tweaks.php' );
 
    /**
     * Make theme available for translation
     * Translations can be filed in the /languages/ directory
     * If you're building a theme based on Dev-theme, use a find and replace
     * to change 'Dev-theme' to the name of your theme in all the template files
     */
    load_theme_textdomain( 'devtheme', get_template_directory() . '/languages' );
 
    /**
     * Add default posts and comments RSS feed links to head
     */
    add_theme_support( 'automatic-feed-links' );
 
    /**
     * Enable support for the Aside Post Format
     */
    add_theme_support( 'post-formats', array( 'aside' ) );
 
    /**
     * This theme uses wp_nav_menu() in one location.
     */
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'devtheme' ),
    ) );
}
endif; // Dev-theme_setup
add_action( 'after_setup_theme', 'devtheme_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Dev-theme 1.0
 */
function devtheme_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Primary Widget Area', 'devtheme' ),
        'id' => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ) );
 
    register_sidebar( array(
        'name' => __( 'Secondary Widget Area', 'devtheme' ),
        'id' => 'sidebar-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ) );
}
add_action( 'widgets_init', 'devtheme_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function devtheme_scripts() {
    wp_enqueue_style( 'style', get_stylesheet_uri() );
 
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
 
    wp_enqueue_script( 'navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
 
    if ( is_singular() && wp_attachment_is_image() ) {
        wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
    }
}
add_action( 'wp_enqueue_scripts', 'devtheme_scripts' );

function reset_css_enqueue() {
   
    wp_register_style( 'reset-css', get_template_directory_uri() .  '/css/reset.css', false, NULL, 'all' );

    wp_enqueue_style( 'reset-css' );
}
add_action( 'wp_enqueue_scripts', 'reset_css_enqueue' );

function bootstrap_enqueue() {
    wp_register_script( 'bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js', array('jquery'), NULL, true );
    wp_register_style( 'bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css', false, NULL, 'all' );
	wp_register_style( 'bootstrap-theme-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css', false, NULL, 'all' );

    wp_enqueue_script( 'bootstrap-js' );
    wp_enqueue_style( 'bootstrap-css' );
    wp_enqueue_style( 'bootstrap-theme-css' );
}
add_action( 'wp_enqueue_scripts', 'bootstrap_enqueue' );

/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * Hooks into the after_setup_theme action.
 *
 */
function devtheme_register_custom_background() {
    $args = array(
        'default-color' => 'e9e0d1',
    );
 
    $args = apply_filters( 'devtheme_custom_background_args', $args );
 
    if ( function_exists( 'wp_get_theme' ) ) {
        add_theme_support( 'custom-background', $args );
    } else {
        define( 'BACKGROUND_COLOR', $args['default-color'] );
        define( 'BACKGROUND_IMAGE', $args['default-image'] );
        add_custom_background();
    }
}
add_action( 'after_setup_theme', 'devtheme_register_custom_background' );
 
/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * theme options test ???
 */
 

 
 function theme_settings_page(){
	 
	 ?>
	    <div class="wrap">
	    <h1>WordPress Theme Development - Theme Options</h1>
	    <form method="post" action="options.php">
	        <?php
	            settings_fields("section");
	            do_settings_sections("theme-options");      
	            submit_button(); 
	        ?>          
	    </form>
		</div>
	<?php
	 
 }
 
 function display_twitter_element()
{
	?>
    	<input type="text" name="twitter_url" id="twitter_url" value="<?php echo get_option('twitter_url'); ?>" />
    <?php
}

function display_facebook_element()
{
	?>
    	<input type="text" name="facebook_url" id="facebook_url" value="<?php echo get_option('facebook_url'); ?>" />
    <?php
}

function display_layout_element()
{
      $theme_array = array ('Boxed' => 'container','Wide'=>'container-fluid');
	 $theme_setting = get_option('theme_layout');
	?>
	<select name="theme_layout">
	<?php
	foreach ($theme_array as $key => $setting){
	?>
	<option value="<?php echo $setting; ?>" <?php if ($theme_setting == $setting) {echo 'selected';}?>><?php echo $key;?></option>
	<?php
	}?>
	</select>
	<?php
	
}

function display_theme_panel_fields()
{
	add_settings_section("section", "All Settings", null, "theme-options");
	
	add_settings_field("twitter_url", "Twitter Profile Url", "display_twitter_element", "theme-options", "section");
    add_settings_field("facebook_url", "Facebook Profile Url", "display_facebook_element", "theme-options", "section");
    add_settings_field("theme_layout", "Do you want a boxed or wide layout?", "display_layout_element", "theme-options", "section");

    register_setting("section", "twitter_url");
    register_setting("section", "facebook_url");
    register_setting("section", "theme_layout");
}

add_action("admin_init", "display_theme_panel_fields");

function add_theme_menu_item()
{
	add_menu_page("Theme Options", "Theme Options", "manage_options", "theme-options", "theme_settings_page", null, 99);
}

add_action("admin_menu", "add_theme_menu_item");