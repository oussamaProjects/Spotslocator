<?php
/*
Plugin Name: Spots Locator
Plugin URI: #
Description: Wordpress plugin allow to search/find locations in the map
Author: Oussama Elmaaroufy
Version: 1.0
Author URI: #
*/

  
define( 'SPOT_LOCATOR__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SPOT_LOCATOR__PLUGIN_URL', __FILE__);

require_once( SPOT_LOCATOR__PLUGIN_DIR . '/includes/load-resources.php' );
require_once( SPOT_LOCATOR__PLUGIN_DIR . '/includes/post-type.php' );
require_once( SPOT_LOCATOR__PLUGIN_DIR . '/includes/custom-meta-boxes.php' );
require_once( SPOT_LOCATOR__PLUGIN_DIR . '/includes/save-data.php' );
require_once( SPOT_LOCATOR__PLUGIN_DIR . '/includes/rest-field.php' );
require_once( SPOT_LOCATOR__PLUGIN_DIR . '/includes/shortcodes/map_view.php' );

// Actions 
add_action( 'admin_init', 'spotslocator_enqueue_admin_scripts');
add_action( 'wp_enqueue_scripts', 'load_resources');
add_action( 'init', 'custom_post_type', 0 );

add_action( 'add_meta_boxes_spot', 'register_spot_metabox');
add_action( 'save_post_spot', 'spotslocatore_save_postdata');
add_action( 'save_post_spot', 'spotslocatore_update_title');

// Filters
add_filter( 'rest_prepare_spot', 'post_add_rest_field', 10, 3 );

// Shortcode 
add_shortcode( 'map_view', 'map_view' );

 