<?php
// Register Custom Post Type
function custom_post_type() {

    $labels = array(
        'name' => _x('Spots', 'Post Type General Name', 'spotslocator'),
        'singular_name' => _x('Spot', 'Post Type Singular Name', 'spotslocator'),
        'menu_name' => __('Spots', 'spotslocator'),
        'name_admin_bar' => __('spot', 'spotslocator'),
        'archives' => __('Item Archives', 'spotslocator'),
        'attributes' => __('Item Attributes', 'spotslocator'),
        'parent_item_colon' => __('Parent Item:', 'spotslocator'),
        'all_items' => __('All spots', 'spotslocator'),
        'add_new_item' => __('Add New spot', 'spotslocator'),
        'add_new' => __('Add New spot', 'spotslocator'),
        'new_item' => __('New spot', 'spotslocator'),
        'edit_item' => __('Edit spot', 'spotslocator'),
        'update_item' => __('Update spot', 'spotslocator'),
        'view_item' => __('View spot', 'spotslocator'),
        'view_items' => __('View spots', 'spotslocator'),
        'search_items' => __('Search spot', 'spotslocator'),
        'not_found' => __('Spot Not found', 'spotslocator'),
        'not_found_in_trash' => __('Not found in Trash', 'spotslocator'),
        'featured_image' => __('Featured Image', 'spotslocator'),
        'set_featured_image' => __('Set featured image', 'spotslocator'),
        'remove_featured_image' => __('Remove featured image', 'spotslocator'),
        'use_featured_image' => __('Use as featured image', 'spotslocator'),
        'insert_into_item' => __('Insert into spot', 'spotslocator'),
        'uploaded_to_this_item' => __('Uploaded to this spot', 'spotslocator'),
        'items_list' => __('Spots list', 'spotslocator'),
        'items_list_navigation' => __('Spots list navigation', 'spotslocator'),
        'filter_items_list' => __('Filter spot list', 'spotslocator'),
    );

    $args = array(
        'label' => __('Spot', 'spotslocator'),
        'description' => __('Post Type Description', 'spotslocator'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail'),
        'taxonomies' => array('spot_cat'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'rest_base' => 'spot',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
        'register_meta_box_cb' => 'spotslocatore_register_spot_metabox',
    );

    register_post_type('spot', $args);

}


function custom_theme_setup(){
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'custom_theme_setup');

