<?php
/**
 * File responsible to create functions to show html or responses
 *
 * @package WordPress
 */


/**
 * Adiciona um script no footer que vai inserir uma variável js com uma URL
 * que será utilizada para requisições AJAX
 *
 * phpcs:disabled WordPress.Security.EscapeOutput.OutputNotEscaped
 */
function _theme_load_ajax() {
	$script  = '<script>';
	$script .= 'var ajaxUrl = "' . admin_url( 'admin-ajax.php' ) . '";';
	$script .= '</script>';

	echo $script;
}
add_action( 'wp_footer', '_theme_load_ajax' );

function _theme_get_awards() {

    $cache_key = 'awards_data_cache';
    $cached_data = get_transient( $cache_key );

    if ( $cached_data ) {
        return $cached_data;
    }

    $response = wp_remote_get( SME_API_BASE_URL . '/awards', [
        'headers' => [
            'Authorization' => 'Bearer ' . SME_API_TOKEN
        ],
        'timeout' => 10,
    ]);

    if ( is_wp_error( $response ) ) {
        return false;
    }

    $body = wp_remote_retrieve_body( $response );
    $data = json_decode( $body, true );

    if ( !$data ) {
        return false;
    }

    set_transient( $cache_key, $data, 2 * HOUR_IN_SECONDS );

    return $data;
}