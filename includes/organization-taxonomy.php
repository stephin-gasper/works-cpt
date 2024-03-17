<?php

namespace SG_WORKS;

/**
 * Register custom category for organization.
 *
 * @since 1.0.3
 */
function register_organization_custom_category()
{
    $labels = [
        'name' => _x('Organizations', 'taxonomy general name', 'sg_works'),
        'singular_name' => _x('Organization', 'taxonomy singular name', 'sg_works'),
        'search_items' => __('Search Organizations', 'sg_works'),
        'all_items' => __('All Organizations', 'sg_works'),
        'parent_item' => __('Parent Organization', 'sg_works'),
        'parent_item_colon' => __('Parent Organization:', 'sg_works'),
        'edit_item' => __('Edit Organization', 'sg_works'),
        'update_item' => __('Update Organization', 'sg_works'),
        'add_new_item' => __('Add New Organization', 'sg_works'),
        'new_item_name' => __('New Organization Name', 'sg_works'),
        'menu_name' => __('Organization', 'sg_works'),
    ];

    $args = [
        'hierarchical' => false,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'organization'],
        'show_in_rest' => true,
        'rest_base' => 'organization'
    ];

    register_taxonomy('organization', ['work'], $args);
}
add_action('init', __NAMESPACE__ . '\register_organization_custom_category', 0);
