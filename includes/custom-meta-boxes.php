<?php
 
function register_spot_metabox(){
    add_meta_box('spot_mb', __('Spot infos', 'spotslocatore'), 'build_spot_mb', 'spot', 'normal', 'high', null);
}

function build_spot_mb($post){

    global $pagenow;
    $spot_data = get_post_meta($post->ID);
    
    // if ( 'post.php' === $pagenow && isset($_GET['post']) && 'spot' === get_post_type( $_GET['post'] ) ): 
    ?>
    <div id="spot" class="columns">
        
        
        <div class="column"> 
            <h3 class="title">Référent: </h3>
            <div class="field-group">
                <div class="label">Nom:</div>
                <input type="text" name="spot_field__nom_ref" class="arpr-form-text" value="<?= $spot_data['spot_field__nom_ref'][0]; ?>"> 
            </div> 

            <div class="field-group">
                <div class="label">Téléphone:</div>
                <input type="tel" name="spot_field__tel_ref" class="arpr-form-text" value="<?= $spot_data['spot_field__tel_ref'][0]; ?>"> 
            </div> 

            <div class="field-group">
                <div class="label">Adresse E-mail:</div>
                <input type="email" name="spot_field__email_ref" class="arpr-form-text" value="<?= $spot_data['spot_field__email_ref'][0]; ?>">
            </div>

            
            <h3 class="title">Center: </h3>
            <div class="field-group">
                <div class="label">Nom:</div>
                <input type="text" name="spot_field__nom_center" class="arpr-form-text" value="<?= $spot_data['spot_field__nom_center'][0]; ?>"> 
            </div>  

            <div class="field-group">
                <div class="label">Adresse:</div>
                <input type="text" name="spot_field__address_center" class="arpr-form-text" value="<?= $spot_data['spot_field__address_center'][0]; ?>">
            </div>
            
            <div class="field-group">
                <div class="label">City:</div>
                <input type="text" name="spot_field__city_address_center" class="arpr-form-text" value="<?= $spot_data['spot_field__city_address_center'][0]; ?>">
            </div>
            
            <div class="field-group">
                <div class="label">Zip code:</div>
                <input type="text" name="spot_field__zip_address_center" class="arpr-form-text" value="<?= $spot_data['spot_field__zip_address_center'][0]; ?>">
            </div>
            
            <div class="field-group"> 
                <div class="label">Téléphone:</div>
                <input type="tel" name="spot_field__tel_center" class="arpr-form-text" value="<?= $spot_data['spot_field__tel_center'][0]; ?>"> 
            </div> 

            <div class="field-group">
                <div class="label">Adresse E-mail:</div>
                <input type="email" name="spot_field__email_center" class="arpr-form-text" value="<?= $spot_data['spot_field__email_center'][0]; ?>">
            </div>

            <div class="field-group">
                <div class="label">Site Web:</div>
                <input type="text" name="spot_field__website_center" class="arpr-form-text" value="<?= $spot_data['spot_field__website_center'][0]; ?>">
            </div>
        </div>
         
        <div class="column">
            <h3 class="title">Position: </h3>
            <div class="field-group">
                <div class="label">Latitude:</div>
                <input type="text" name="spot_field__lat" class="arpr-form-text" value="<?= $spot_data['spot_field__lat'][0]; ?>">
            </div>

            <div class="field-group">
                <div class="label">Longitude:</div>
                <input type="text" name="spot_field__lon" class="arpr-form-text" value="<?= $spot_data['spot_field__lon'][0]; ?>">
            </div>
            

            <h3 class="title">Text :</h3>
            <div class="field-group">
                <div class="label">Text:</div>
                <textarea name="spot_field__text" id="spot_field__text" class="arpr-form-textarea" row="10"><?= $spot_data['spot_field__text'][0] ?></textarea>
            </div>
        </div>
           
         
    </div>
     
    <?php 
    // endif; 
    ?>
    <?php
}
