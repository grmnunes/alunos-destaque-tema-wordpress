<?php
/**
 * File responsible for registering all post_types
 *
 * @package WordPress
 */

/**
 * Utilize o exemplo abaixo para criar custom post types
 * Link para os icones do WP: https://developer.wordpress.org/resource/dashicons
 * Exemplo:
 *       array(
 *           'name' => 'Plural Name',
 *           'singular_name'=> 'Singular Name',
 *           'slug' => 'slug',
 *           'dashicon' => '',
 *           'taxonomy' => array(
 *              array(
 *                  'name' => 'Taxonomy Name',
 *                  'slug' => 'taxonomy-slug',
 *              )
 *           )
 *       ),
 *
 * @return array
 */
function _theme_post_types() {
	return [];
}
