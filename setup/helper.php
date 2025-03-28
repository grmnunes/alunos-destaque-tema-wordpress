<?php
/**
 * This file aims to centralize all the helper functionalities
 *
 * @file helper.php
 * @package setup
 */


/**
 * Ativa alguns features do WordPress
 */
function _theme_setup() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	register_nav_menus(
		[
			'main'   => esc_html__( 'Principal' ),
			'footer' => esc_html__( 'Rodapé' ),
		]
	);

}
add_action( 'after_setup_theme', '_theme_setup' );

/**
 * Gera URL de compartilhamento nas redes sociais
 *
 * @param string   $socialNetwork Nome da rede social.
 * @param int|null $postId ID do post current.
 *
 * @return string
 */
function _theme_social_share( string $socialNetwork, int $postId = null ): string {
	if ( null === $postId ) {
		global $post;
		$postId = $post->ID;
	}

	$baseUrlFacebook = 'https://www.facebook.com/sharer.php?u=';
	$socialNetworks  = [
		'facebook' => $baseUrlFacebook . get_permalink( $postId ) . '&t=' . rawurlencode( get_the_title( $postId ) ),
		'twitter'  => 'https://twitter.com/intent/tweet?text=' . rawurlencode( get_permalink( $postId ) ),
		'whatsapp' => 'https://wa.me/?text=' . get_permalink( $postId ),
		'telegram' => 'https://t.me/share/url?url=' . get_permalink( $postId ),
		'linkedin' => 'https://www.linkedin.com/cws/share?url=' . get_permalink( $postId ),
	];

	if ( ! isset( $socialNetworks[ $socialNetwork ] ) ) {
		return '';
	}

	return $socialNetworks[ $socialNetwork ];
}
