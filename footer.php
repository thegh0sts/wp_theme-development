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
</div><!-- #page .hfeed .site -->
 
<?php wp_footer(); ?>
 <script>
 <?php echo $code_body = get_option('code_body');?>
 </script>
</body>
</html>