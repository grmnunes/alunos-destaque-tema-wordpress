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
// phpcs:enabled WordPress.Security.EscapeOutput.OutputNotEscaped

/**
 * Renderiza o código do analytics salvo pelo ACF no admin
 *
 * @return false|string
 */
function _theme_render_analytics() {
	if ( function_exists( 'get_field' ) ) {
		$codeAnalytics = get_field( 'analytics_code', 'option' );
		if ( ! empty( $codeAnalytics ) ) {
			ob_start();
			?>
            <?php // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedScript ?>
			<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( $codeAnalytics ); ?>">
			</script>
			<script>
				window.dataLayer = window.dataLayer || [];
				function gtag(){dataLayer.push(arguments);}
				gtag('js', new Date());

				gtag('config', '<?php echo esc_attr( $codeAnalytics ); ?>');
			</script>
			<?php

			return ob_get_clean();
		}
	}
}

/**
 * Retorna imagem destacada, caso não tenha ele retorna o placeholder
 *
 * @param int|null $postId ID do post current.
 * @return false|mixed|string|null
 */
function _theme_get_thumbnail( int $postId = null ) {
	$thumb = get_field( 'placeholder', 'options' );
	if ( null !== $postId ) {
		if ( has_post_thumbnail( $postId ) ) {
			$thumb = get_the_post_thumbnail_url( $postId );
		}
	}

	return $thumb;
}

/**
 * Retorna a logo principal
 *
 * @return mixed|null
 */
function _theme_get_logo() {
	return get_field( 'logo', 'options' );
}

/**
 * Retorna a logo do rodapé
 *
 * @return mixed|null
 */
function _theme_get_footer_logo() {
	return get_field( 'footer_logo', 'options' );
}