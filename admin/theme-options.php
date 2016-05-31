<?php 
add_action('admin_menu', 'ch_essentials_admin');
function ch_essentials_admin() {
    /* Base Menu */
    add_menu_page(
    'WP Dev Theme',
    'WP Dev Theme',
    'manage_options',
    'theme-options',
    'theme_options_index');
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
	foreach ($dd_header_width as $header_key => $header_setting){
	?>
	<option value="<?php echo $header_setting; ?>" <?php if ($header_width_setting == $header_setting) {echo 'selected';}?>><?php echo $header_key;?></option>
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
function theme_options_index() {
?>
    <div class="wrap">  
        <div id="icon-themes" class="icon32"></div>  
        <h2>WP Dev Theme Options</h2>  
        <?php settings_errors(); ?>  

        <?php  
                $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'all_general_settings_page';  
        ?>  

        <h2 class="nav-tab-wrapper" style="border:3px solid blue">  
            <a href="?page=theme-options&tab=all_general_settings_page" class="nav-tab <?php echo $active_tab == 'all_general_settings_page' ? 'nav-tab-active' : ''; ?>">General Options</a>  
            <a href="?page=theme-options&tab=all_responsive_settings_page" class="nav-tab <?php echo $active_tab == 'all_responsive_settings_page' ? 'nav-tab-active' : ''; ?>">Responsive / Layout Options</a>  
			<a href="?page=theme-options&tab=all_extra_settings_page" class="nav-tab <?php echo $active_tab == 'all_extra_settings_page' ? 'nav-tab-active' : ''; ?>">Extra Options</a>  
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