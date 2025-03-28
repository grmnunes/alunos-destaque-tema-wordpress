<?php
/**
 * Theme Core
 *
 * @package WordPress
 */

/**
 * Registra todos os custom post types adicionados no arquivo post-types.php
 *
 * phpcs:disabled Generic.Metrics.CyclomaticComplexity.TooHigh
 * phpcs:disabled Squiz.Commenting.FunctionComment.EmptyThrows
 * phpcs:disabled Squiz.Commenting.FunctionCommentThrowTag.Missing
 *
 * @throws Exception
 */
function _theme_register_custom_post_types() {
	$parameters = _theme_post_types();
	if ( ! is_array( $parameters ) ) {
		throw new \Exception( 'Invalid parameters' );
	}

	foreach ( $parameters as $parameter ) {
		register_post_type(
			'post_' . $parameter['slug'],
			[
				'labels'      => [
					'name'               => ( $parameter['name'] ),
					'singular_label'     => ( $parameter['singular_name'] ),
					'menu_name'          => ( $parameter['name'] ),
					'parent_item_colon'  => ( 'Parent' ),
					'all_items'          => __( 'Listar todos' ),
					'view_item'          => __( 'Visualizar' ),
					'add_new_item'       => ( 'Adicionar ' . $parameter['singular_name'] ),
					'add_new'            => ( 'Adicionar ' . $parameter['singular_name'] ),
					'edit_item'          => ( 'Editar ' . $parameter['singular_name'] ),
					'update_item'        => ( 'Atualizar ' . $parameter['singular_name'] ),
					'search_items'       => ( 'Pesquisar ' . $parameter['singular_name'] ),
					'not_found'          => __( 'Registro não encontrado' ),
					'not_found_in_trash' => __( 'Nenhum registro encontrado na lixeira' ),
				],
				'menu_icon'   => $parameter['dashicon'] ? $parameter['dashicon'] : 'dashicons-welcome-widgets-menus',
				'public'      => true,
				'has_archive' => false,
				'rewrite'     => [ 'slug' => strtolower( $parameter['singular_name'] ) ],
				'supports'    => [ 'title', 'editor', 'thumbnail', 'excerpt', 'author', 'revisions', 'comments' ],
			]
		);

		if ( ! empty( $parameter['taxonomy'] ) && count( $parameter['taxonomy'] ) ) {
			foreach ( $parameter['taxonomy'] as $value ) {
				register_taxonomy(
					'tax_' . $parameter['slug'] . '_' . strtolower( $value['slug'] ),
					'post_' . $parameter['slug'],
					[
						'label'        => ( $value['name'] ),
						'rewrite'      => [
							'slug' => $parameter['slug'] . '-' . str_replace( ' ', '-', strtolower( $value['name'] ) ),
						],
						'hierarchical' => true,
					]
				);
			}
		}
	}
}
add_action( 'init', '_theme_register_custom_post_types' );
// phpcs:enabled Generic.Metrics.CyclomaticComplexity.TooHigh
// phpcs:enabled Squiz.Commenting.FunctionComment.EmptyThrows
// phpcs:enabled Squiz.Commenting.FunctionCommentThrowTag.Missing

if ( function_exists( 'add_theme_support' ) ) {
	add_image_size( 'admin-thumb', 100, 100 );
}

add_filter( 'manage_posts_columns', '_theme_config_thumbnail_in_list', 5 );
add_action( 'manage_posts_custom_column', '_theme_show_thumbnail_in_list', 5, 2 );

/**
 * Configura imagem destacada para ser exibida na listagem dos posts
 *
 * @param mixed $defaults Parametro default.
 * @return mixed
 */
function _theme_config_thumbnail_in_list( $defaults ) {
	$defaults['custom_post_thumbs'] = __( 'Imagem destacada' );
	return $defaults;
}

/**
 * Exibe a imagem destacada na listagem dos posts
 *
 * @param mixed $columnName Nome da coluna.
 */
function _theme_show_thumbnail_in_list( $columnName ) {
	if ( 'custom_post_thumbs' === $columnName ) {
		the_post_thumbnail( 'admin-thumb' );
	}
}

/**
 * Gera menu com submenus usando recursividade
 *
 * @param array $elements Filhos do menu.
 * @param int   $parentId ID do Menu Pai.
 *
 * @return array
 *
 * phpcs:disabled Generic.Metrics.CyclomaticComplexity.TooHigh
 */
function _theme_build_menu( array &$elements, int $parentId = 0 ) {
	$data = [];
	foreach ( $elements as &$element ) {
		if ( (int) $element->menu_item_parent === $parentId ) {
			$children = _theme_build_menu( $elements, $element->ID );
			if ( $children ) {
				$element->children = $children;
			}

			$data[ $element->ID ] = $element;
			unset( $element );
		}
	}

	return $data;
}
// phpcs:enabled Generic.Metrics.CyclomaticComplexity.TooHigh

/**
 * Retorna um menu no formato de array pelo ID
 *
 * @param mixed $menuId Id do Menu.
 * @return array
 */
function _theme_get_menu( $menuId ) {
	$locations = get_nav_menu_locations();
	if ( ! isset( $locations[ $menuId ] ) ) {
		return [];
	}

	$menuId = $locations[ $menuId ];
	$items  = wp_get_nav_menu_items( $menuId );

	return $items ? _theme_build_menu( $items, 0 ) : [];
}

/**
 * Exibe a Role do autor junto com seu nome no select que é exibido dentro do post
 *
 * @return string
 */
function _theme_show_role_author() {
	global $post;

	$output = '<select id="post_author_override" name="post_author_override">';
	$users  = get_users();
	foreach ( $users as $user ) {
		$userId = $post->post_author;

		$selected = $userId === $user->data->ID ? "selected='selected'" : '';
		$output  .= '<option value="' . $user->data->ID . '" ' . $selected . '>'
			. $user->data->user_login . ' (' . $user->roles[0] . ')</option>';
	}
	$output .= '</select>';

	return $output;
}
add_filter( 'wp_dropdown_users', '_theme_show_role_author', 10, 2 );
add_filter( 'post_author_meta_box', '_theme_show_role_author' );
