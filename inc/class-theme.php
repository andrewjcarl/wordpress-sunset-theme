<?php
/**
 * Theme Class
 *
 * @see     https://github.com/woocommerce/storefront/blob/master/inc/class-storefront.php
 * 
 * @package Wordpress
 * @subpackage sunset-theme
 * @since   1.0.0
 * @version 1.0.0
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Theme' ) ) :

	/**
	 * The main Theme class
	 */
	class Theme {

		/**
		 * Setup class.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			add_action( 'after_setup_theme', array( $this, 'setup' ) );
			add_action( 'widgets_init', array( $this, 'widgets_init' ) );
            add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ), 10 );
            add_action( 'after_setup_theme', array( $this, 'menu_init' ) );
            add_filter( 'widget_nav_menu_args', array( $this, 'widget_nav_menu_args'), 10, 3 );
            add_filter( 'get_the_archive_title', array( $this, 'theme_archive_title_filter') );
            add_filter( 'excerpt_more', array( $this, 'filter_excerpt_more_text') );
            // add_filter( 'walker_nav_menu_start_el', array( $this, 'nav_menu_social_icons' ), 10, 4 );
            add_filter( 'walker_nav_menu_start_el', array( $this, 'nav_menu_primary_icons' ), 11, 4 );
        }
        
        /**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
         * 
         * @since 1.0.0
		 */
		public function setup() {

	        //	general wordpress theme support
            add_theme_support( 'title-tag' ); 
            add_theme_support( 'automatic-feed-links' );
        }

        /**
		 * Register widget area.
		 *
         * @since 1.0.0
		 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
		 */
		public function widgets_init() {
            //  register sidebars here
        }

        /**
		 * Enqueue scripts and styles.
		 *
         * @version 1.0.0
		 * @since   1.0.0
		 */
		public function scripts() {
            $theme_version = wp_get_theme()->get( 'Version' );

            $styles = array(
                'main-style' => '/assets/dist/main.css',
                //'prism-style' => '/assets/css/prism.css',
            );

            foreach( $styles as $style => $path ) {
                wp_enqueue_style( $style, get_template_directory_uri() . $path, null, $theme_version );
            }

            //  queue javascript files
            wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/js/index.js', array(), $theme_version, false );
        }

        /**
		 * Main navigation menus 
		 *
		 * @since  1.0.0
		 */
		public function menu_init() {
            $locations = array(
                'primary'  => __( 'Main Menu', 'andrewcarl' ),
                'expanded' => __( 'Expanded Menu', 'andrewcarl' ),
            );
        
            register_nav_menus( $locations );
        }

        /**
         * Add default link_before and link_after args when not provided
         * Fixing when menu is used in a widget context 
         * 
         * @param	stdClass $args	Wordpress Menu Args
         * @return  stdClass $args	Wordpress Menu args 
         * 
         * @since 1.0.0
         */
        function widget_nav_menu_args( $args ) {
            $args['link_before'] 	= !empty($args['link_before']) ? $args['link_before'] : '<span>';
            $args['link_after'] 	= !empty($args['link_after'])  ? $args['link_after']  : '</span>';
            
            return $args;
        }

        /**
         * Filter get_the_archive_title to remove the Category:= prefix
         * 
         * @since 1.0.0
         */
        function theme_archive_title_filter($title) {    
            if ( is_category() ) {    
                    $title = single_cat_title( '', false );    
                } elseif ( is_tag() ) {    
                    $title = single_tag_title( '', false );    
                } elseif ( is_author() ) {    
                    $title = '<span class="vcard">' . get_the_author() . '</span>' ;    
                } elseif ( is_tax() ) { //for custom post types
                    $title = sprintf( __( '%1$s' ), single_term_title( '', false ) );
                } elseif (is_post_type_archive()) {
                    $title = post_type_archive_title( '', false );
                }
            return $title;    
        }

        /**
         * Filter the excerpt "read more" string.
         *
         * @param string $more "Read more" excerpt string.
         * @return string (Maybe) modified "read more" excerpt string.
         * 
         * @since 1.0.0
         */
        function filter_excerpt_more_text( $more ) {
            return '...';
        }

        /**
         * Display SVG icons in social links menu.
         *
         * @param  string  $item_output The menu item output.
         * @param  WP_Post $item        Menu item object.
         * @param  int     $depth       Depth of the menu.
         * @param  array   $args        wp_nav_menu() arguments.
         * @return string  $item_output The menu item output with social icon.
         * 
         * @since 1.0.0
         */
        function nav_menu_social_icons( $item_output, $item, $depth, $args ) {
            // Change SVG icon inside social links menu if there is supported URL.
            if ( 'social' === $args->theme_location || 'social' === $args->menu->slug) {
                $svg = Theme_SVG_Icons::get_social_link_svg( $item->url );
                if ( empty( $svg ) ) {
                    $svg = get_theme_svg( 'link' );
                }
                $item_output = str_replace( $args->link_after, '</span>' . $svg, $item_output );
                $item_output = str_replace( $args->link_before, '<span class="screen-reader-text icon-large">', $item_output);
            }

            return $item_output;
        }

        /**
         * Display SVG icons in primary menu
         * 
         * @since 1.0.0
         */
        function nav_menu_primary_icons( $item_output, $item, $depth, $args ) {
            // Change SVG icon inside social links menu if there is supported URL.
            if ( 'primary' === $args->theme_location ) {
                $svg = Theme_SVG_Icons::get_icon_link_svg( $item->title );
                if ( !empty( $svg ) ) {
                    $item_output = str_replace( $args->link_before, $svg . $args->link_before, $item_output );
                }
            }

            return $item_output;
        }
    }
endif; 

return new Theme();