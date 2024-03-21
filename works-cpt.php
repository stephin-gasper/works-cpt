<?php
/**
 * Works CPT
 *
 * @package       SG_WORKS
 * @license       mit
 * @author        Stephin Gasper
 * @version       1.0.3
 *
 * @wordpress-plugin
 * Plugin Name:   Works Custom Post Type
 * Description:   A CPT for showing projects and contributions made by developer
 * Version:       1.0.3
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
 * Include the 'work category' taxonomy file to register custom taxonomy
 */
require_once dirname(__FILE__) . '/includes/work-category-taxonomy.php';

/**
 * Include the 'tech stack' taxonomy file to register custom taxonomy & its meta fields.
 */
require_once dirname(__FILE__) . '/includes/tech-stack-taxonomy.php';

/**
 * Include the 'organization' taxonomy file to register custom taxonomy
 */
require_once dirname(__FILE__) . '/includes/organization-taxonomy.php';

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
	$tech_stack_terms = get_terms(
		array(
			'taxonomy' => 'tech_stack',
			'parent' => 0,
			'hide_empty' => false,
		)
	);

	$tech_stack_options = array();

	if (!empty ($tech_stack_terms)) {
		foreach ($tech_stack_terms as $category) {
			$tech_stack_options[$category->name] = $category->name;
		}
	}

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
				'name' => 'Website Active',
				'id' => 'is_website_active',
				'type' => 'radio',
				'std' => 'true',
				'options' => [
					'true' => 'Yes',
					'false' => 'No',
				],
			),
			array(
				'name' => 'Project Status',
				'id' => 'project_status',
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
				'id' => 'taxonomy_tech_stack',
				'type' => 'taxonomy',
				'taxonomy' => 'tech_stack',
				'inline' => true,
				'select_all_none' => true,
				'field_type' => 'checkbox_list',
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
				'name' => 'Organization',
				'id' => 'taxonomy_work_organization',
				'type' => 'taxonomy',
				'taxonomy' => 'work_organization',
				'inline' => true,
				'field_type' => 'radio_list',
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
				'clone' => true,
			)
		),
	);
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', __NAMESPACE__ . '\add_work_metabox');