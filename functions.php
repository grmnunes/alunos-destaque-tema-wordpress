<?php
/**
 * The functions.php file uses PHP code to add features or change default features on a WordPress site.
 *
 * @file functions.php
 * @package WordPress
 */

/**
 * Função para inicializar o tema
 */
function initialize() {
	$files = [
		'plugins/acf-gallery/acf-gallery.php',
		'plugins/acf-options-page/acf-options-page.php',
		'plugins/acf-repeater/acf-repeater.php',
		'setup/assets.php',
		'setup/acf.php',
		'setup/core.php',
		'setup/helper.php',
		'setup/post-types.php',
		'setup/render.php',
	];

	foreach ( $files as $file ) {
		$filePath = locate_template( $file );
		if ( ! $filePath ) {
			error_log( sprintf( __( 'Error locating %s for inclusion' ), $file ), E_USER_ERROR );
		}
		include_once "{$filePath}";
	}
}

if ( ! function_exists( 'dd' ) ) {
	/**
	 * Var_dump and die method
	 *
	 * @param mixed $data Qualquer tipo de dado para ser debugado.
	 *
	 * @return void
	 */
	function dd( $data ) {
        // phpcs:disabled WordPress.Security.EscapeOutput.OutputNotEscaped
		ini_set( 'highlight.comment', '#969896; font-style: italic' );
		ini_set( 'highlight.default', '#FFFFFF' );
		ini_set( 'highlight.html', '#D16568' );
		ini_set( 'highlight.keyword', '#7FA3BC; font-weight: bold' );
		ini_set( 'highlight.string', '#F2C47E' );

		$output = highlight_string( "<?php\n\n" . var_export( $data, true ), true );

		echo "<div style=\"background-color: #1C1E21; padding: 1rem\">{$output}</div>";
		die;
	}
}

initialize();
