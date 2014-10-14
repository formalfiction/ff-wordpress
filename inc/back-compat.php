<?php
/**
 * FF Wordpress back compat functionality
 *
 * Prevents FF Wordpress from running on WordPress versions prior to 3.6,
 * since this theme is not meant to be backward compatible beyond that
 * and relies on many newer functions and markup changes introduced in 3.6.
 *
 * @package WordPress
 * @subpackage FF_Wordpress
 * @since FF Wordpress 1.0
 */

/**
 * Prevent switching to FF Wordpress on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since FF Wordpress 1.0
 */
function ff_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'ff_upgrade_notice' );
}
add_action( 'after_switch_theme', 'ff_switch_theme' );

/**
 * Add message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * FF Wordpress on WordPress versions prior to 3.6.
 *
 * @since FF Wordpress 1.0
 */
function ff_upgrade_notice() {
	$message = sprintf( __( 'FF Wordpress requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'ff' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevent the Theme Customizer from being loaded on WordPress versions prior to 3.6.
 *
 * @since FF Wordpress 1.0
 */
function ff_customize() {
	wp_die( sprintf( __( 'FF Wordpress requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'ff' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'ff_customize' );

/**
 * Prevent the Theme Preview from being loaded on WordPress versions prior to 3.4.
 *
 * @since FF Wordpress 1.0
 */
function ff_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'FF Wordpress requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'ff' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'ff_preview' );
