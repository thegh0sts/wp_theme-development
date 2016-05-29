<?php
//
// Dev-theme functions and definitions
//
// @package Dev-theme
// @since Dev-theme 1.0
//
 
//
// Set the content width based on the theme's design and stylesheet.
//
// @since Dev-theme 1.0
//
 


if ( ! function_exists( 'devtheme_setup' ) ):
//
// Sets up theme defaults and registers support for various WordPress features.
//
// Note that this function is hooked into the after_setup_theme hook, which runs
// before the init hook. The init hook is too late for some features, such as indicating
// support post thumbnails.
//
// @since Dev-theme 1.0
//
function devtheme_setup() {
 
    //
     // Custom template tags for this theme.
     //
    require( get_template_directory() . '/inc/template-tags.php' );
 
    //
     // Custom functions that act independently of the theme templates
     //
    require( get_template_directory() . '/inc/tweaks.php' );
 
    //
     // Make theme available for translation
     // Translations can be filed in the /languages/ directory
     // If you're building a theme based on Dev-theme, use a find and replace
     // to change 'Dev-theme' to the name of your theme in all the template files
     //
    load_theme_textdomain( 'devtheme', get_template_directory() . '/languages' );
 
    //
     // Add default posts and comments RSS feed links to head
     //
    add_theme_support( 'automatic-feed-links' );
 
    //
     // Enable support for the Aside Post Format
     //
    add_theme_support( 'post-formats', array( 'aside' ) );
 
    //
     // This theme uses wp_nav_menu() in one location.
     //
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'devtheme' ),
    ) );
}
endif; // Dev-theme_setup
add_action( 'after_setup_theme', 'devtheme_setup' );

//
 // Register widgetized area and update sidebar with default widgets
 //
 // @since Dev-theme 1.0
 //
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

//
// Enqueue scripts and styles
//
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

//
// Setup the WordPress core custom background feature.
//
// Use add_theme_support to register support for WordPress 3.4+
// as well as provide backward compatibility for previous versions.
// Use feature detection of wp_get_theme() which was introduced
// in WordPress 3.4.
 //
 // Hooks into the after_setup_theme action.
 //
 //
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
 
//
// Implement the Custom Header feature
//
require( get_template_directory() . '/inc/custom-header.php' );

add_action('admin_menu', 'ch_essentials_admin');
function ch_essentials_admin() {
    /* Base Menu */
    add_menu_page(
    'Essentials Theme',
    'Essentials Theme',
    'manage_options',
    'ch-essentials-options',
    'ch_essentials_index');
}

/* Options
-----------------------------------------------------------------*/
add_action('admin_init', 'ch_essentials_options');
function ch_essentials_options() { 

// General Options

add_settings_section( 
    'all_general_settings_page',
    'General Options',
    'general_settings_callback',
    'general_settings'
);

add_settings_field(  
    'general_head_code',                      
    'Code before closing HEAD tag',               
    'general_head_code_callback',   
    'general_settings',                     
    'all_general_settings_page'
);

add_settings_field(  
    'general_body_code',                      
    'Code before closing BODY tag',               
    'general_body_code_callback',   
    'general_settings',                     
    'all_general_settings_page'
);

add_settings_field(  
    'general_ga_code',                      
    'Google Analytics code',               
    'general_ga_code_callback',   
    'general_settings',                     
    'all_general_settings_page'
);

register_setting('general_settings', 'general_head_code');
register_setting('general_settings', 'general_body_code');
register_setting('general_settings', 'general_ga_code');

// Responsive / Layout Options

add_settings_section( 
    'all_responsive_settings_page',
    'Responsive / Layout Options',
    'responsive_settings_callback',
    'responsive_settings'
);

add_settings_field(  
    'responsive_header_width',                      
    'Do you want the header to be wide or boxed?',               
    'responsive_header_width_callback',   
    'responsive_settings',                     
    'all_responsive_settings_page'
);

add_settings_field(  
    'responsive_body_width',                      
    'Do you want the body to be wide or boxed?',               
    'responsive_body_width_callback',   
    'responsive_settings',                     
    'all_responsive_settings_page'
);

register_setting('responsive_settings', 'responsive_header_width');
register_setting('responsive_settings', 'responsive_body_width');

add_settings_section( 
    'all_extra_settings_page',
    'Extra Options',
    'extra_settings_callback',
    'extra_settings'
);

add_settings_field(  
    'extra_custom_css',                      
    'Enter your custom CSS here',               
    'extra_custom_css_callback',   
    'extra_settings',                     
    'all_extra_settings_page'
);

register_setting('extra_settings', 'extra_custom_css');

}

/* Call Backs
-----------------------------------------------------------------*/
function general_settings_callback() { 
    echo '<p>General Options:</p>'; 
}

function responsive_settings_callback() { 
    echo '<p>Responsive / Layout Options:</p>'; 
}

function extra_settings_callback() { 
    echo '<p>Extra Options:</p>'; 
}

function general_head_code_callback($args) { 

  //  $general_head_code = get_option('head_code'); 

    ?>
    <textarea id="general_head_code" class="general_head_code" name="general_head_code" rows="5" cols="50"><?php echo get_option('general_head_code') ?></textarea>
    <p class="description general_head_code"> <?php echo $args[0] ?> </p>
    <?php 


}

function general_body_code_callback($args) { 

  //  $general_head_code = get_option('head_code'); 

    ?>
    <textarea id="general_body_code" class="general_body_code" name="general_body_code" rows="5" cols="50"><?php echo get_option('general_body_code') ?></textarea>
    <p class="description general_body_code"> <?php echo $args[0] ?> </p>
    <?php 


}

function general_ga_code_callback($args) { 

  //  $general_head_code = get_option('head_code'); 

    ?>
    <textarea id="general_ga_code" class="general_ga_code" name="general_ga_code" rows="5" cols="50"><?php echo get_option('general_ga_code') ?></textarea>
    <p class="description general_ga_code"> <?php echo $args[0] ?> </p>
    <?php 


}

function responsive_header_width_callback($args){
	
	  $dd_header_width = array ('Boxed' => 'container','Wide'=>'container-fluid');
	 $header_width_setting = get_option('responsive_header_width');
	?>
	<select name="responsive_header_width">
	<?php
	foreach ($dd_header_width as $header_key => $width_setting){
	?>
	<option value="<?php echo $width_setting; ?>" <?php if ($header_width_setting == $width_setting) {echo 'selected';}?>><?php echo $header_key;?></option>
	<?php
	}?>
	</select>
	<?php    
	
}

function responsive_body_width_callback($args){
	
	  $dd_body_width = array ('Boxed' => 'container','Wide'=>'container-fluid');
	 $body_width_setting = get_option('responsive_body_width');
	?>
	<select name="responsive_body_width">
	<?php
	foreach ($dd_body_width as $body_key => $width_setting){
	?>
	<option value="<?php echo $width_setting; ?>" <?php if ($body_width_setting == $width_setting) {echo 'selected';}?>><?php echo $body_key;?></option>
	<?php
	}?>
	</select>
	<?php    
	
}

function extra_custom_css_callback($args) { 

  //  $general_head_code = get_option('head_code'); 
$file = file_get_contents(get_template_directory_uri() . "/css/custom.css");
    ?>
    <textarea id="extra_custom_css" class="extra_custom_css" name="extra_custom_css" rows="5" cols="50"><?php echo $file ?></textarea>
    <p class="description extra_custom_css"> <?php echo $args[0] ?> </p>
    <?php 

	//if (isset(submit_button())){
		$new_file = $_POST['extra_custom_css'];
	$file = fopen("custom.css", 'w');
		fwrite($file,$new_file);
		fclose($file);
	//}
	

}

/* Display Page
-----------------------------------------------------------------*/
function ch_essentials_index() {
?>
    <div class="wrap">  
        <div id="icon-themes" class="icon32"></div>  
        <h2>Essentials Theme Options</h2>  
        <?php settings_errors(); ?>  

        <?php  
                $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'all_general_settings_page';  
        ?>  

        <h2 class="nav-tab-wrapper">  
            <a href="?page=ch-essentials-options&tab=all_general_settings_page" class="nav-tab <?php echo $active_tab == 'all_general_settings_page' ? 'nav-tab-active' : ''; ?>">General Options</a>  
            <a href="?page=ch-essentials-options&tab=all_responsive_settings_page" class="nav-tab <?php echo $active_tab == 'all_responsive_settings_page' ? 'nav-tab-active' : ''; ?>">Responsive / Layout Options</a>  
			<a href="?page=ch-essentials-options&tab=all_extra_settings_page" class="nav-tab <?php echo $active_tab == 'all_extra_settings_page' ? 'nav-tab-active' : ''; ?>">Extra Options</a>  
        </h2>  


        <form method="post" action="options.php">  

            <?php 
            if( $active_tab == 'all_general_settings_page' ) {  
                settings_fields( 'general_settings' );
                do_settings_sections( 'general_settings' ); 
            } else if( $active_tab == 'all_responsive_settings_page' ) {
                settings_fields( 'responsive_settings' );
                do_settings_sections( 'responsive_settings' ); 

            }else if( $active_tab == 'all_extra_settings_page' ) {
                settings_fields( 'extra_settings' );
                do_settings_sections( 'extra_settings' ); 

            }
            ?>             
            <?php submit_button(); ?>  
        </form> 

    </div> 
<?php
}

/* Shortcodes
---------------------------------------------------------*/
function one_half_shortcode( $atts, $content = null ) {
	return '<div class="col-md-6">' . $content . '</div>';
}
add_shortcode( 'one_half', 'one_half_shortcode' );