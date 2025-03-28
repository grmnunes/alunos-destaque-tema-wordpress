<?php
/**
 * This file aims to centralize all the functionalities related to the ACF plugin
 *
 * @file acf.php
 * @package setup
 */

if ( function_exists( 'acf_set_options_page_title' ) ) {
	acf_set_options_page_title( __( 'Theme Options' ) );
}

/**
 * Para evitar que erros em caso da falta do plugin ACF, essa função cria os métodos básicos do ACF
 *
 * phpcs:disabled Generic.Metrics.CyclomaticComplexity.MaxExceeded
 */
function override_function_acf() {
	if ( ! class_exists( 'ACF' ) ) {
		if ( ! function_exists( 'get_field' ) ) {
			/**
			 * Retorna o response da função
			 *
			 * @override
			 */
			function get_field() {
				return null;
			}
		}

		if ( ! function_exists( 'the_field' ) ) {
			/**
			 * Imprime o response da função
			 *
			 * @override
			 */
			function the_field() {
				return null;
			}
		}

		if ( ! function_exists( 'get_sub_field' ) ) {
			/**
			 * Retorna o valor do subcampo
			 *
			 * @override
			 */
			function get_sub_field() {
				return null;
			}
		}

		if ( ! function_exists( 'the_sub_field' ) ) {
			/**
			 * Imprime o valor do subcampo
			 *
			 * @override
			 */
			function the_sub_field() {
				return null;
			}
		}

		if ( ! function_exists( 'the_sub_field' ) ) {
			/**
			 * Verifica se tem um campo tem subcampos
			 *
			 * @override
			 */
			function have_rows() {
				return null;
			}
		}
	}
}

add_action( 'plugins_loaded', 'override_function_acf' );
// phpcs:enabled Generic.Metrics.CyclomaticComplexity.MaxExceeded
