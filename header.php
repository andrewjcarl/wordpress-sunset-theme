<?php
/**
 * Header file 
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage kaneh_theme
 * @since 1.0.0
 */

?><!DOCTYPE html>

<!--[if lt IE 7 ]> <html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 ie-lt10 ie-lt9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 ie-lt10 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<!-- the "no-js" class is for Modernizr. -->

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >

		<link rel="profile" href="https://gmpg.org/xfn/11">

        <!-- Always force latest IE rendering engine (even in intranet) -->
        <!--[if IE ]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <![endif]-->

        <?php
            if ( is_search() ) {
                echo '<meta name="robots" content="noindex, nofollow" />';
            }
        ?>

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

		<?php wp_body_open(); ?>
    
		<header id="site-header" role="banner" class="<?php if ( is_home() || is_front_page() ) { echo 'is-home'; } ?>">
            <div class="header-inner">
                <h1><?php echo __('Andrew Carl', 'andrewcarl'); ?></h1>
                <?php
                    if (has_nav_menu('primary')) :
                        wp_nav_menu(array(
                            'container' => 'nav',
                            'container_class' => 'menu',
                            'theme_location' => 'primary',
                            'link_before' => '<span>',
                            'link_after' => '</span>'
                        ));
                    endif;
                ?>
            </div><!-- .header-inner -->
        </header>
