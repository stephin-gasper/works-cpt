<?php

namespace SG_WORKS;

/**
 * Register custom category for tech stack.
 *
 * @since 1.0.2
 */
function register_tech_stack_custom_category()
{
    $labels = [
        'name' => _x('Tech Stacks', 'taxonomy general name', 'sg_works'),
        'singular_name' => _x('Tech Stack', 'taxonomy singular name', 'sg_works'),
        'search_items' => __('Search Tech Stacks', 'sg_works'),
        'all_items' => __('All Tech Stacks', 'sg_works'),
        'parent_item' => __('Parent Tech Stack', 'sg_works'),
        'parent_item_colon' => __('Parent Tech Stack:', 'sg_works'),
        'edit_item' => __('Edit Tech Stack', 'sg_works'),
        'update_item' => __('Update Tech Stack', 'sg_works'),
        'add_new_item' => __('Add New Tech Stack', 'sg_works'),
        'new_item_name' => __('New Tech Stack Name', 'sg_works'),
        'menu_name' => __('Tech Stack', 'sg_works'),
    ];

    $args = [
        'hierarchical' => false,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'tech-stack'],
        'show_in_rest' => true,
        'rest_base' => 'tech-stack'
    ];

    register_taxonomy('tech_stack', ['work'], $args);
}
add_action('init', __NAMESPACE__ . '\register_tech_stack_custom_category', 0);

/**
 * Register additional fields to tech stack taxonomy rest api response.
 * 
 * - Adds 'image_url' to response
 *
 * @since 1.0.2
 */
function register_taxonomy_tech_stack_meta()
{
    register_term_meta('tech_stack', 'image_url', array('type' => 'string', 'single' => true, 'show_in_rest' => true));
}
add_action('init', __NAMESPACE__ . '\register_taxonomy_tech_stack_meta');

/**
 * Add additional fields when adding new tech stack.
 * 
 * - Adds 'image_url' field
 *
 * @since 1.0.2
 */
function add_form_field_to_taxonomy_tech_stack()
{
    // add a nonce for security
    wp_nonce_field('tech_stack_meta_new', 'tech_stack_meta_new_nonce');
    ?>
    <div class="form-field term-image-url-wrap">
        <label for="tag-image-url">
            <?php _e('Image Url', 'sg_works'); ?>
        </label>
        <input name="image_url" id="image-url" type="url" value="" aria-describedby="image-url-description" />
        <p class="image-url-description">
            <?php _e('Image to show with the text.', 'sg_works'); ?>
        </p>
    </div>
    <?php
}
add_action('tech_stack_add_form_fields', __NAMESPACE__ . '\add_form_field_to_taxonomy_tech_stack');

/**
 * Add additional fields when editing existing tech stack.
 * 
 * - Adds 'image_url' field
 *
 * @since 1.0.2
 */
function edit_form_field_to_taxonomy_tech_stack(\WP_Term $term)
{
    $image_url = get_term_meta($term->term_id, 'image_url', true);
    // add a nonce for security
    wp_nonce_field('tech_stack_meta_edit', 'tech_stack_meta_edit_nonce');
    ?>

    <tr class="form-field image-url-wrap">
        <th scope="row">
            <label for="image-url">
                <?php _e('Image Url', 'sg_works'); ?>
            </label>
        </th>
        <td><input name="image_url" id="image-url" type="url" value="<?php echo esc_attr($image_url); ?>"
                aria-describedby="image-url-description" />
            <p class="image-url-description">
                <?php _e('Image to show with the text.', 'sg_works'); ?>
            </p>
        </td>
    </tr>
    <?php
}
add_action('tech_stack_edit_form_fields', __NAMESPACE__ . '\edit_form_field_to_taxonomy_tech_stack', 10, 1);

/**
 * Save meta values of tech stack when term is created/edited
 * 
 * - Save value for 'image_url' field
 *
 * @since 1.0.2
 */
function save_tech_stack_meta(int $term_id)
{
    if (!isset($_POST['image_url'])) {
        return;
    }

    if (!isset($_POST['tech_stack_meta_new_nonce']) && !isset($_POST['tech_stack_meta_edit_nonce'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['tech_stack_meta_new_nonce'], 'tech_stack_meta_new') && !wp_verify_nonce($_POST['tech_stack_meta_edit_nonce'], 'tech_stack_meta_edit')) {
        return;
    }

    $image_url_value = sanitize_text_field($_POST['image_url']);
    update_term_meta($term_id, 'image_url', $image_url_value);
}
add_action('created_tech_stack', __NAMESPACE__ . '\save_tech_stack_meta', 10, 1);
add_action('edited_tech_stack', __NAMESPACE__ . '\save_tech_stack_meta', 10, 1);

/**
 * Add new column to taxonomy tech_stack
 * 
 * @since 1.0.2
 */
function add_column_for_taxonomy_tech_stack(array $columns): array
{
    $columns['image_url'] = __('Image Url', 'sg_works');
    return $columns;
}

add_filter('manage_edit-tech_stack_columns', __NAMESPACE__ . '\add_column_for_taxonomy_tech_stack', 10, 1);

/**
 * Show content of term meta.
 * 
 * @since 1.0.2
 */
function add_content_for_taxonomy_tech_stack(string $content, string $column_name, int $term_id)
{
    // Skip if this is not our column
    if ($column_name != 'image_url') {
        return;
    }

    $image_url = get_term_meta($term_id, 'image_url', true);

    // Skip if term or field does not exist
    if (!$image_url) {
        return;
    }

    echo esc_attr($image_url);
}

add_action('manage_tech_stack_custom_column', __NAMESPACE__ . '\add_content_for_taxonomy_tech_stack', 10, 3);
