<?php


function post_add_rest_field( $data, $post, $context ) {
	
	$title_alias = get_post_meta( $post->ID, 'spot_field__nom_ref', true ); // get the value from the meta field
    $img = get_the_post_thumbnail_url( $post->ID );
    
	if( $title_alias ) { //Check if filled
		$data->data['spot_json'] = array( 
			get_post_meta(get_the_ID(),'spot_field__ID',true) => array(
                'logo'  => esc_url( $img ),
                'name' => get_the_title(),
                'ref' =>  array(
                    'nom_ref' => $title_alias,
                    'email_ref' => get_post_meta(get_the_ID(),'spot_field__email_ref',true),
                    'tel_ref' => get_post_meta(get_the_ID(),'spot_field__tel_ref',true)
                ),
                'center' =>  array(
                    'nom_center' => get_post_meta(get_the_ID(),'spot_field__nom_center',true), 
                    'tel_center' => get_post_meta(get_the_ID(),'spot_field__tel_center',true), 
                    'website_center' => get_post_meta(get_the_ID(),'spot_field__website_center',true),  
                ),
                'address' =>  array(
                    'adr' => get_post_meta(get_the_ID(),'spot_field__address_center',true),
                    'cit' => get_post_meta(get_the_ID(),'spot_field__city_address_center',true),
                    'zip' => get_post_meta(get_the_ID(),'spot_field__zip_address_center',true)
                ),
                'position' =>  array(
                    'lat' => get_post_meta(get_the_ID(),'spot_field__lat',true),
                    'lon' => get_post_meta(get_the_ID(),'spot_field__lon',true),
                ),
                'text' => get_post_meta(get_the_ID(),'spot_field__text',true),
            )
		);
	}
	
	return $data;
}

