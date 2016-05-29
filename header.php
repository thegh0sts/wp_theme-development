<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Dev-theme
 * @since Dev-theme 1.0
 */
?><!DOCTYPE html>
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
/*
* Print the <title> tag based on what is being viewed.
*/
global $page, $paged;
 
wp_title( '|', true, 'right' );
 
// Add the blog name.
bloginfo( 'name' );
 
// Add the blog description for the home/front page.
$site_description = get_bloginfo( 'description', 'display' );
if ( $site_description && ( is_home() || is_front_page() ) )
echo " | $site_description";
 
// Add a page number if necessary:
if ( $paged >= 2 || $page >= 2 )
echo ' | ' . sprintf( __( 'Page %s', 'devtheme' ), max( $paged, $page ) );
 
?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<script id="head_code">
<?php echo $head_code = get_option('general_head_code');?>
</script>

<script id="google_analytics">
<?php echo $ga = get_option('general_ga_code');?>
</script>

<?php wp_head(); ?>
</head>
 
<body <?php body_class(); ?>>

<div id="page" class="hfeed site container-fluid">
<div class="row">
<header id="masthead" class="site-header <?php echo $responsive_header_width = get_option('responsive_header_width');?>" role="banner">
<div class="row">
     <section class="col-md-12">
         
     <h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
 <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>	 
	 </section><!-- #masthead .site-header -->
	  <nav role="navigation" class="site-navigation main-navigation col-md-12 navbar navbar-inverse">
    
     <?php wp_nav_menu( array( 'theme_location' => 'primary','menu_class'=> 'nav navbar-nav') ); ?>
</nav><!-- .site-navigation .main-navigation -->
<?php $header_image = get_header_image();
        if ( ! empty( $header_image ) ) { ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                <img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
            </a>
<?php } // if ( ! empty( $header_image ) )
?>
</div>
</header>

<div id="main" class="site-main <?php echo $responsive_body_width = get_option('responsive_body_width');?>">