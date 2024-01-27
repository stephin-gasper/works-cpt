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
 * Plugin Name:   Works Custom Post Type
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
if (!defined('ABSPATH'))
	exit;

/**
 * Register a Work custom post type.
 *
 * @since 1.0.0
 */
function register_work_post_type()
{
	$labels = [
		'name' => _x('Works', 'post type general name', 'sg_works'),
		'singular_name' => _x('Work', 'post type singular name', 'sg_works'),
		'menu_name' => _x('Works', 'admin menu', 'sg_works'),
		'name_admin_bar' => _x('Work', 'add new on admin bar', 'sg_works'),
		'add_new' => _x('Add New', 'Work', 'sg_works'),
		'add_new_item' => __('Add New Work', 'sg_works'),
		'new_item' => __('New Work', 'sg_works'),
		'edit_item' => __('Edit Work', 'sg_works'),
		'view_item' => __('View Work', 'sg_works'),
		'all_items' => __('All Works', 'sg_works'),
		'search_items' => __('Search Works', 'sg_works'),
		'parent_item_colon' => __('Parent Works:', 'sg_works'),
		'not_found' => __('No Works found.', 'sg_works'),
		'not_found_in_trash' => __('No Works found in Trash.', 'sg_works'),
	];

	$args = [
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'rewrite' => ['slug' => 'work'],
		'show_in_rest' => true,
		'rest_base' => 'work',
		'menu_position' => 5,
		'menu_icon' => 'dashicons-id-alt',
		'supports' => array('title', 'thumbnail', 'excerpt', 'editor', 'page-attributes'),
	];

	register_post_type('work', $args);
}
add_action('init', __NAMESPACE__ . '\register_work_post_type');

/**
 * Register custom category for work.
 *
 * @since 1.0.0
 */
function register_custom_category()
{
	$labels = [
		'name' => _x('Work Categories', 'taxonomy general name', 'sg_works'),
		'singular_name' => _x('Work Category', 'taxonomy singular name', 'sg_works'),
		'search_items' => __('Search Work Categories', 'sg_works'),
		'all_items' => __('All Work Categories', 'sg_works'),
		'parent_item' => __('Parent Work Category', 'sg_works'),
		'parent_item_colon' => __('Parent Work Category:', 'sg_works'),
		'edit_item' => __('Edit Work Category', 'sg_works'),
		'update_item' => __('Update Work Category', 'sg_works'),
		'add_new_item' => __('Add New Work Category', 'sg_works'),
		'new_item_name' => __('New Work Category Name', 'sg_works'),
		'menu_name' => __('Work Category', 'sg_works'),
	];

	$args = [
		'hierarchical' => false,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => ['slug' => 'work-category'],
		'show_in_rest' => true,
		'rest_base' => 'work-category'
	];

	register_taxonomy('work_category', ['work'], $args);
}
add_action('init', __NAMESPACE__ . '\register_custom_category', 0);

/**
 * Add custom meta box for 'work' custom post type.
 *
 * Adds a custom meta box named 'Work Details' to the 'work' custom post type.
 * The meta box allows users to enter additional details for each work entry, including website URL, tech stack highlights, tech stack, platform, github url, domain, featured image url( useful when hosting images separately).
 * 
 * @since 1.0.0
 */
function add_work_metabox($meta_boxes)
{
	$tech_stack_options = [
		'javascript' => 'JavaScript',
		'php' => 'PHP',
		'wordpress' => 'WordPress',
		'html5' => 'HTML5',
		'css3' => 'CSS3',
		'jquery' => 'jQuery',
		'scss' => 'SCSS',
		'react' => 'ReactJS',
		'react_native' => 'React Native',
		'deno' => 'Deno',
		'node' => 'node.js',
		'puppeteer' => 'Puppeteer',
		'next' => 'NextJS',
		'express' => 'express.js',
		'redux' => 'ReduxJS',
		'styled_component' => 'Styled Components',
		'jest' => 'Jest',
		'jotai' => 'Jotai',
		'react_testing_library' => 'React Testing Library',
		'react_native_testing_library' => 'React Native Testing Library',
	];
	$meta_boxes[] = array(
		'id' => 'work_details',
		'title' => 'Work Details',
		'post_types' => array('work'),
		'fields' => array(
			array(
				'name' => 'Website Url',
				'id' => 'website_url',
				'type' => 'url',
			),
			array(
				'name' => 'Tech Stack Highlighted',
				'id' => 'tech_stack_highlighted',
				'type' => 'checkbox_list',
				'inline' => true,
				'select_all_none' => true,
				'options' => $tech_stack_options,
			),
			array(
				'name' => 'Tech Stack',
				'id' => 'tech_stack',
				'type' => 'checkbox_list',
				'inline' => true,
				'select_all_none' => true,
				'options' => $tech_stack_options,
			),
			array(
				'name' => 'Platform',
				'id' => 'platform',
				'type' => 'checkbox_list',
				'inline' => true,
				'select_all_none' => true,
				'options' => [
					'web' => 'Web',
					'mobile' => 'Mobile',
					'backend' => 'Backend',
				],
			),
			array(
				'name' => 'Github Url',
				'id' => 'github_url',
				'type' => 'url',
			),
			array(
				'name' => 'Domain',
				'id' => 'domain',
				'placeholder' => 'Enter domain of work'
			),
			array(
				'name' => 'Featured Image Url',
				'id' => 'featured_image_url',
				'type' => 'url',
			),
		),
	);
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', __NAMESPACE__ . '\add_work_metabox');