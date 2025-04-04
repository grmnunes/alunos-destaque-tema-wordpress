<?php
/**
 * Registers the scripts to theme
 *
 * @package WordPress
 */

/**
 * Registra os arquivos de CSS e JS do tema
 */
function _theme_assets() {
	$uri = get_template_directory_uri();
	wp_enqueue_style( '_theme-style', $uri . '/assets/css/main.css', [], '1.0.0' );
	wp_enqueue_script( '_theme-js-main', $uri . '/assets/js/main.js', [], '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', '_theme_assets' );
