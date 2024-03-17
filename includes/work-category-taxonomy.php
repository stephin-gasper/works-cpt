<?php

namespace SG_WORKS;

/**
 * Register custom category for work.
 *
 * @since 1.0.0
 */
function register_work_custom_category()
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
add_action('init', __NAMESPACE__ . '\register_work_custom_category', 0);
