<<<<<<< HEAD
<?php /* ----------------------------------------------------------------------------- */
=======
<<<<<<< HEAD
<?php /* ----------------------------------------------------------------------------- */
=======
 /* ----------------------------------------------------------------------------- */
>>>>>>> df453d3a3b4f2d3bab54a66ae71ab1014abc57dc
>>>>>>> e114004cef74632b9fef0ceb140e30cb08205a39
    /* Option 1 */
    /* ----------------------------------------------------------------------------- */ 

    add_settings_field (   
        'option_1',                      // ID used to identify the field throughout the theme  
        'Option 1',                           // The label to the left of the option interface element  
        'option_1_callback',   // The name of the function responsible for rendering the option interface  
        'general',                          // The page on which this option will be displayed  
        'page_1_section',         // The name of the section to which this field belongs  
        array(                              // The array of arguments to pass to the callback. In this case, just a description.  
            'This is the description of the option 1',
        )  
    );  
    register_setting(  
        //~ 'my-menu-slug',  
        'setting-group-1',  
        'option_1'  
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> e114004cef74632b9fef0ceb140e30cb08205a39
    );
	
	// ----------------------------------------------------------------------------- ///
// Add Menu Page ///
// ----------------------------------------------------------------------------- /// 

function add_my_menu() {
    add_menu_page (
        'Theme Options', // page title 
        'Theme Options', // menu title
        'manage_options', // capability
        'theme-options',  // menu-slug
        'my_menu_page',   // function that will render its output
        get_template_directory_uri() . '/assets/ico/theme-option-menu-icon.png'   // link to the icon that will be displayed in the sidebar
        //$position,    // position of the menu option
    );
}
add_action('admin_menu', 'add_my_menu');
function my_menu_page() {
        ?>
        <?php  
        if( isset( $_GET[ 'tab' ] ) ) {  
            $active_tab = $_GET[ 'tab' ];  
        } else {
            $active_tab = 'tab_one';
        }
        ?>  
        <div class="wrap">
            <h2>Menu Page Title</h2>
            <div class="description">This is description of the page.</div>
            <?php settings_errors(); ?> 

            <h2 class="nav-tab-wrapper">  
                <a href="?page=theme-options&tab=tab_one" class="nav-tab <?php echo $active_tab == 'tab_one' ? 'nav-tab-active' : ''; ?>">General</a>  
                <a href="?page=theme-options&tab=tab_two" class="nav-tab <?php echo $active_tab == 'tab_two' ? 'nav-tab-active' : ''; ?>">Responsive / Layout</a>  
            </h2>  

            <form method="post" action="options.php"> 
            <?php
                if( $active_tab == 'tab_one' ) {  

                    settings_fields( 'general-group' );
                    do_settings_sections( 'general' );

                } elseif( $active_tab == 'tab_two' )  {

                    settings_fields( 'responsive-layout-group' );
                    do_settings_sections( 'responsive-layout' );

                }
            ?>

                <?php submit_button(); ?> 
            </form> 

        </div>
        <?php
}

// ----------------------------------------------------------------------------- ///
// Setting Sections And Fields ///
// ----------------------------------------------------------------------------- /// 

function sandbox_initialize_theme_options() {  
    add_settings_section(  
        'page_1_section',         // ID used to identify this section and with which to register options  
        'General Settings',                  // Title to be displayed on the administration page  
        'page_1_section_callback', // Callback used to render the description of the section  
        'general'                           // Page on which to add this section of options  

    );

    add_settings_section(  
        'page_2_section',         // ID used to identify this section and with which to register options  
        'Responsive / Layout Settings',                  // Title to be displayed on the administration page  
        'page_2_section_callback', // Callback used to render the description of the section  
        'responsive-layout'                           // Page on which to add this section of options  
    );
	
	add_settings_section(  
        'page_3_section',         // ID used to identify this section and with which to register options  
        'Responsive / Layout Settings',                  // Title to be displayed on the administration page  
        'page_3_section_callback', // Callback used to render the description of the section  
        'responsive-layout'                           // Page on which to add this section of options  
    );

// ----------------------------------------------------------------------------- ///
// Fields - General Settings ///
// ----------------------------------------------------------------------------- ///    

// Code in <head> tag ///     

    add_settings_field (   
        'code_head',  // ID -- ID used to identify the field throughout the theme  
        'Enter your custom code that belongs in the head tag.', // LABEL -- The label to the left of the option interface element  
        'code_head_callback', // CALLBACK FUNCTION -- The name of the function responsible for rendering the option interface  
        'general', // MENU PAGE SLUG -- The page on which this option will be displayed  
        'page_1_section', // SECTION ID -- The name of the section to which this field belongs  
        array( // The array of arguments to pass to the callback. In this case, just a description.  
            'Do not include script tags.', // DESCRIPTION -- The description of the field.
        )  
    );
    register_setting(  
        'general-group',  
        'code_head'  
    );
	
// Code in <body> tag ///     

    add_settings_field (   
        'code_body',  // ID -- ID used to identify the field throughout the theme  
        'Enter your custom code that belongs before the end body tag.', // LABEL -- The label to the left of the option interface element  
        'code_body_callback', // CALLBACK FUNCTION -- The name of the function responsible for rendering the option interface  
        'general', // MENU PAGE SLUG -- The page on which this option will be displayed  
        'page_1_section', // SECTION ID -- The name of the section to which this field belongs  
        array( // The array of arguments to pass to the callback. In this case, just a description.  
            'Do not include script tags.', // DESCRIPTION -- The description of the field.
        )  
    );
    register_setting(  
        'general-group',  
        'code_body'  
    );
	
// ----------------------------------------------------------------------------- ///
// Fields - Responsive / Layout Settings ///
// ----------------------------------------------------------------------------- ///   

// Wide or Boxed layout - content /// 

    add_settings_field (   
        'theme_layout',  // ID -- ID used to identify the field throughout the theme  
        'Do you want the content to be in a Wide or Boxed layout?', // LABEL -- The label to the left of the option interface element  
        'responsive_layout_callback', // CALLBACK FUNCTION -- The name of the function responsible for rendering the option interface  
        'responsive-layout', // MENU PAGE SLUG -- The page on which this option will be displayed  
        'page_2_section', // SECTION ID -- The name of the section to which this field belongs  
        array( // The array of arguments to pass to the callback. In this case, just a description.  
            'This is the description of the option 3', // DESCRIPTION -- The description of the field.
        )  
    );
    register_setting(  
        'responsive-layout-group',  
        'theme_layout'  
    );
	
	
// Wide or Boxed layout - header /// 

    add_settings_field (   
        'header_layout',  // ID -- ID used to identify the field throughout the theme  
        'Do you want the header to be in a Wide or Boxed layout?', // LABEL -- The label to the left of the option interface element  
        'header_responsive_layout_callback', // CALLBACK FUNCTION -- The name of the function responsible for rendering the option interface  
        'header-responsive-layout', // MENU PAGE SLUG -- The page on which this option will be displayed  
        'page_2_section', // SECTION ID -- The name of the section to which this field belongs  
        array( // The array of arguments to pass to the callback. In this case, just a description.  
            'This is the description of the option 3', // DESCRIPTION -- The description of the field.
        )  
    );
    register_setting(  
        'responsive-layout-group',  
        'header_layout'  
    );


} // function sandbox_initialize_theme_options
add_action('admin_init', 'sandbox_initialize_theme_options');

function page_1_section_callback() {  
    echo '<p>Section Description here</p>';  
} // function page_1_section_callback
function page_2_section_callback() {  
    echo '<p>This theme is designed to be responsive and therefore any responsive nature cannot be disabled.</p>';  
} // function page_1_section_callback

// ----------------------------------------------------------------------------- ///
// Field Callbacks - General Settings ///
// ----------------------------------------------------------------------------- /// 

function code_body_callback($args) {  
    ?>
    <textarea id="code_body" class="code_body" name="code_body" rows="5" cols="50"><?php echo get_option('code_body') ?></textarea>
    <p class="description code_body"> <?php echo $args[0] ?> </p>
    <?php      
} // end sandbox_toggle_header_callback 

function code_head_callback($args) {  
    ?>
    <textarea id="code_head" class="code_head" name="code_head" rows="5" cols="50"><?php echo get_option('code_head') ?></textarea>
    <p class="description code_head"> <?php echo $args[0] ?> </p>
    <?php      
} // end sandbox_toggle_header_callback  

// ----------------------------------------------------------------------------- ///
// Field Callbacks - Responsive / Layout Settings ///
// ----------------------------------------------------------------------------- /// 

function responsive_layout_callback($args) {  
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
} // end sandbox_toggle_header_callback  

function header_responsive_layout_callback($args) {  
     $header_array = array ('Boxed' => 'container','Wide'=>'container-fluid');
	 $header_page_setting = get_option('header_layout');
	?>
	<select name="header_layout">
	<?php
	foreach ($header_array as $key => $setting){
	?>
	<option value="<?php echo $setting; ?>" <?php if ($header_setting == $setting) {echo 'selected';}?>><?php echo $key;?></option>
	<?php
	}?>
	</select>
	<?php     
<<<<<<< HEAD
} // end sandbox_toggle_header_callback 
=======
} // end sandbox_toggle_header_callback 
=======
    );
>>>>>>> df453d3a3b4f2d3bab54a66ae71ab1014abc57dc
>>>>>>> e114004cef74632b9fef0ceb140e30cb08205a39
