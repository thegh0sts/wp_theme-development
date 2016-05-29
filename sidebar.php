<?php
/**
* The Sidebar containing the main widget areas.
*
* @package Dev-theme
* @since Dev-theme 1.0
*/
?>
<div id="secondary" class="widget-area" role="complementary">
    <?php do_action( 'before_sidebar' ); ?>
    <?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
 
        
 
    <?php endif; // end sidebar widget area ?>
</div><!-- #secondary .widget-area -->
<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
 
     <div id="tertiary" class="widget-area" role="supplementary">
      <?php dynamic_sidebar( 'sidebar-2' ); ?>
     </div><!-- #tertiary .widget-area -->
 
<?php endif; ?>