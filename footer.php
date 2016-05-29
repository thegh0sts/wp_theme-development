<?php
/**
* The template for displaying the footer.
*
* Contains the closing of the id=main div and all content after
*
* @package Dev-theme
* @since Dev-theme 1.0
*/
?>
 
</div><!-- #main .site-main -->
 
<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="site-info">
        <?php do_action( 'devtheme_credits' ); ?>
        <a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'devtheme' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'devtheme' ), 'WordPress' ); ?></a>
        <span class="sep"> | </span>
        <?php printf( __( 'Theme: %1$s by %2$s.', 'devtheme' ), 'Dev-theme', '<a href="https://themedevthemer.com/" rel="designer">ThemeDev-themer</a>' ); $facebook_url = get_option('facebook_url');
echo $twitter_url = get_option('twitter_url');?>
    
	</div><!-- .site-info -->
</footer><!-- #colophon .site-footer -->
</div>
</div><!-- #page .hfeed .site -->
 
<?php wp_footer(); ?>
 <script>
<<<<<<< HEAD
 <?php echo $body_code = get_option('general_body_code');?>
=======
<<<<<<< HEAD
 <?php echo $body_code = get_option('general_body_code');?>
=======
 <?php echo $code_body = get_option('code_body');?>
>>>>>>> df453d3a3b4f2d3bab54a66ae71ab1014abc57dc
>>>>>>> e114004cef74632b9fef0ceb140e30cb08205a39
 </script>
</body>
</html>