<?php

function load_resources()
{

    wp_enqueue_style('front_style', plugins_url('public/css/styles.css', SPOT_LOCATOR__PLUGIN_URL));

    wp_enqueue_script('google_maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDcnLKAxbtX2f_bAGN-e8x3eI_UktTiMbs&amp;libraries=places&amp;language=fr', array(), null, true);
    wp_enqueue_script('markerclustererplus', 'https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js', array(), null, true);

    wp_enqueue_script('jquery-3.4.1', plugins_url('public/js/jquery-3.4.1.min.js', SPOT_LOCATOR__PLUGIN_URL), array(), null, true);
    wp_enqueue_script('jquery-ui-1.12.1', plugins_url('public/js/jquery-ui-1.12.1.min.js', SPOT_LOCATOR__PLUGIN_URL), array(), null, true);
    wp_enqueue_script('slick', plugins_url('public/js/slick.min.js', SPOT_LOCATOR__PLUGIN_URL), array(), null, true);
    wp_enqueue_script('script', plugins_url('public/js/script.js', SPOT_LOCATOR__PLUGIN_URL), array(), null, true);

    // wp_enqueue_script( 'markerclusterer', plugins_url( 'public/js/markerclusterer.js', SPOT_LOCATOR__PLUGIN_URL), array(),null, true);

    wp_register_script('mapfindspots', plugins_url('public/js/mapfindspots.js', SPOT_LOCATOR__PLUGIN_URL), array(), null, true);

    // Localize the script with new data
    wp_localize_script('mapfindspots', 'URLs',
        array(
            // 'jsonUrl' => plugins_url( '/public/spots.json', SPOT_LOCATOR__PLUGIN_URL),
            'jsonUrl' => 'http://icdl.test/wp-json/wp/v2/spot',
        )
    );

    // Enqueued script with localized data.
    wp_enqueue_script('mapfindspots');

}

function spotslocator_enqueue_admin_scripts()
{

    global $post;

    if ('spot' == $post->post_type) {

        wp_enqueue_style( 'admin_style', plugins_url('public/admin/css/admin_styles.css', SPOT_LOCATOR__PLUGIN_URL));
        wp_enqueue_script( 'admin_google_maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDcnLKAxbtX2f_bAGN-e8x3eI_UktTiMbs&amp;libraries=places&amp;language=fr', array(), null, false);
        wp_enqueue_script( 'admin_scripi', plugins_url('public/admin/js/admin_script.js', SPOT_LOCATOR__PLUGIN_URL));
 
    }

}
