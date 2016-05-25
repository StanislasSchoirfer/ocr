<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package ocr_wp
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'ocr_wp' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<nav class="navbar nav-inline navbar-fixed-top navbar-dark bg-inverse" role="navigation">
		   
		   <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" 
		   data-target="#CollapsingNavbar">
    		&#9776;
 		 </button>
 		 <div class="collapse navbar-toggleable-xs" id="CollapsingNavbar">

			<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php 
			
			if (get_custom_header()->height) : ?>
			<img src="<?php header_image(); ?>" id='logo' />
			<?php
			else : 
			bloginfo( 'name' ); 
			endif
			?></a>
    		
				<?php
		             wp_nav_menu([
   									 'menu'            => 'primary',
    								 'theme_location'  => 'primary',
    								 'container'       => 'div',
   									 'container_id'    => 'MenuPrincipal',
   									 'container_class' => '',
 								     'menu_id'         => false,
   									 'menu_class'      => 'nav navbar-nav',
   									 'depth'           => 2,
  									  'fallback_cb'     => 'bs4navwalker::fallback',
  									  'walker'          => new bs4navwalker()
					]);
	        	?>

        </div> <!-- .navbar-collapse -->
        	
		</nav><!-- .navbar .navbar-default -->
	</header><!-- #masthead -->
	<!-- heros  -->
	<section id="big-video">
    <div class="video" data-src="<?php echo get_template_directory_uri(),'/video-header/still.jpg' ; ?>" data-video="<?php echo get_template_directory_uri(),'/video-header/video' ; ?>" data-placeholder="<?php echo get_template_directory_uri(),'/video-header/still.jpg' ; ?>"></div>
</section>
	
	<!-- /hero  -->

	<div id="content" class="site-content">
