<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage kaneh_theme
 * @since 1.0.0
 */

/**
 * Assign the Theme version to a var
 */
$theme         = wp_get_theme();
$theme_version = $theme['Version'];

$kaneh_theme = (object) array(
	'version'    => $theme_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-theme.php',
);

//	Theme Functions & Hooks
require 'inc/theme-functions.php';
require 'inc/theme-template-hooks.php';
require 'inc/theme-template-functions.php';

//	SVG Support
require 'inc/svg-icons.php';
require 'inc/class-svg-icons.php';