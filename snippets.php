 /* ----------------------------------------------------------------------------- */
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
    );