<?php
 
function spotslocatore_save_postdata($post_id){
    if(!is_admin())
        return false;

    $spot_meta = array_filter(
        $_POST,
        function($key){
            return strpos($key, 'spot_field__') !== false;
        },
        ARRAY_FILTER_USE_KEY
    );

    // die(var_dump($spot_meta));

    foreach($spot_meta as $key => $value){

        if(strpos($key, '_email') !== false)
            $sanitized = sanitize_email($value);
        else
            $sanitized = sanitize_text_field($value);

        update_post_meta(
            $post_id,
            $key,
            $sanitized
        );

    }

}


function spotslocatore_update_title( $post_id ){
    
    if ( ! wp_is_post_revision( $post_id ) && !empty($_POST['spot_field__nom_center']) ){
        // unhook this function so it doesn't loop infinitely
        remove_action('save_post_spot', 'spotslocatore_update_title');
        // update the post, which calls save_post_spot again
        $post_title = sprintf('%1$s', sanitize_text_field($_POST['spot_field__nom_center']));
        
        $update_data = array(
            'ID'           => $post_id,
            'post_title'   => $post_title
        );
        
        update_post_meta($post_id, 'spot_field__ID', $post_id, true ); 
        wp_update_post( $update_data );

        // re-hook this function
        add_action('save_post_spot', 'spotslocatore_update_title');
    }
}

// function spot_endpoint() {
 
//     add_rewrite_tag( '%spot%', '([^&]+)' );
//     add_rewrite_rule( 'spot/([^&]+)/?', 'index.php?spot=$matches[1]', 'top' );
 
// }
// add_action( 'init', 'spot_endpoint' );

// function spot_endpoint_data() {
 
//     global $wp_query;
 
//     $spot = $wp_query->get( 'spot' );
 
//     if ( ! $spot ) {
//         return;
//     }
 
//     $spot_data = array();
 
//     $args = array(
//         'post_type'      => 'spot',
//         'posts_per_page' => -1, 
//     );

//     $spot_query = new WP_Query( $args );
//     if ( $spot_query->have_posts() ) : 
//         while ( $spot_query->have_posts() ) : $spot_query->the_post();
            
//             $img_id = get_post_thumbnail_id();
//             $img = wp_get_attachment_image_src( $img_id, 'full' );
//             $spot_data[] = array(
//                 'logo'  => esc_url( $img[0] ),
//                 'name' => get_the_title(),
//                 'ref' =>  array(
//                     'nom_ref' => get_post_meta(get_the_ID(),'spot_field__nom_ref',true),
//                     'email_ref' => get_post_meta(get_the_ID(),'spot_field__email_ref',true),
//                     'tel_ref' => get_post_meta(get_the_ID(),'spot_field__tel_ref',true)
//                 ),
//                 'center' =>  array(
//                     'nom_centre' => get_post_meta(get_the_ID(),'spot_field__nom_center',true), 
//                     'tel_centre' => get_post_meta(get_the_ID(),'spot_field__tel_centre',true), 
//                     'website_center' => get_post_meta(get_the_ID(),'spot_field__website_center',true),  
//                 ),
//                 'adresse' =>  array(
//                     'adr' => get_post_meta(get_the_ID(),'spot_field__address_centre',true),
//                     'cit' => get_post_meta(get_the_ID(),'spot_field__city_address_centre',true),
//                     'zip' => get_post_meta(get_the_ID(),'spot_field__zip_address_centre',true)
//                 ),
//                 'position' =>  array(
//                     'lat' => get_post_meta(get_the_ID(),'spot_field__lat',true),
//                     'lon' => get_post_meta(get_the_ID(),'spot_field__lon',true),
//                 ), 
//             );
 
//         endwhile; 
//         wp_reset_postdata(); 
//     endif;
 
//     wp_send_json( $spot_data );

// }
// add_action( 'template_redirect', 'spot_endpoint_data' );