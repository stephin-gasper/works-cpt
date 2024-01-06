<?php
/**
 * Works CPT
 *
 * @package       SG_WORKS
 * @license       mit
 * @author        Stephin Gasper
 * @version       1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:   Works CPT
 * Description:   A CPT for showing projects and contributions made by developer
 * Version:       1.0.0
 * Author:        Stephin Gasper
 * Author URI:    https://stephin-gasper.vercel.app/
 * Text Domain:   sg_works
 * License:       MIT
 * License URI:   https://mit-license.org/
 */

namespace SG_WORKS;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Register a Work custom post type.
 *
 * @since 1.0.0
 */
function register_work_post_type() {
	$labels = [
		'name'               => _x( 'Works', 'post type general name', 'sg_works' ),
		'singular_name'      => _x( 'Work', 'post type singular name', 'sg_works' ),
		'menu_name'          => _x( 'Works', 'admin menu', 'sg_works' ),
		'name_admin_bar'     => _x( 'Work', 'add new on admin bar', 'sg_works' ),
		'add_new'            => _x( 'Add New', 'Work', 'sg_works' ),
		'add_new_item'       => __( 'Add New Work', 'sg_works' ),
		'new_item'           => __( 'New Work', 'sg_works' ),
		'edit_item'          => __( 'Edit Work', 'sg_works' ),
		'view_item'          => __( 'View Work', 'sg_works' ),
		'all_items'          => __( 'All Works', 'sg_works' ),
		'search_items'       => __( 'Search Works', 'sg_works' ),
		'parent_item_colon'  => __( 'Parent Works:', 'sg_works' ),
		'not_found'          => __( 'No Works found.', 'sg_works' ),
		'not_found_in_trash' => __( 'No Works found in Trash.', 'sg_works' ),
	];

	$args = [
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'rewrite'            => [ 'slug' => 'work' ],
		'show_in_rest'       => true,
		'rest_base' => 'work',
        'menu_position' => 5,
		'menu_icon' => 'dashicons-id-alt',
        'supports' => array('title', 'thumbnail', 'excerpt', 'editor'),
	];

	register_post_type( 'work', $args );
}
add_action( 'init', __NAMESPACE__ . '\register_work_post_type' );

