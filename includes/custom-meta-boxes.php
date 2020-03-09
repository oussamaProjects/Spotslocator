<?php

function spotslocatore_register_spot_metabox()
{
    add_meta_box('spot_mb', __('Spot infos', 'spotslocatore'), 'build_spot_mb', 'spot', 'normal', 'high', null);
}

function build_spot_mb($post)
{

    global $pagenow;
    $spot_data = get_post_meta($post->ID);

    // if ( 'post.php' === $pagenow && isset($_GET['post']) && 'spot' === get_post_type( $_GET['post'] ) ):
    ?>
<div id="spot" class="columns">


    <div class="column">
        <h3 class="title">Référent: </h3>
        <div class="field-group">
            <div class="label">Nom:</div>
            <input type="text" name="spot_field__nom_ref" class="arpr-form-text"
                value="<?=$spot_data['spot_field__nom_ref'][0];?>">
        </div>

        <div class="field-group">
            <div class="label">Téléphone:</div>
            <input type="tel" name="spot_field__tel_ref" class="arpr-form-text"
                value="<?=$spot_data['spot_field__tel_ref'][0];?>">
        </div>

        <div class="field-group">
            <div class="label">Adresse E-mail:</div>
            <input type="email" name="spot_field__email_ref" class="arpr-form-text"
                value="<?=$spot_data['spot_field__email_ref'][0];?>">
        </div>


        <h3 class="title">Center: </h3>
        <div class="field-group">
            <div class="label">Nom:</div>
            <input type="text" name="spot_field__nom_center" class="arpr-form-text"
                value="<?=$spot_data['spot_field__nom_center'][0];?>">
        </div>

        <div class="field-group">
            <div class="label">Adresse:</div>
            <input type="text" name="spot_field__address_center" class="arpr-form-text"
                value="<?=$spot_data['spot_field__address_center'][0];?>">
        </div>

        <div class="field-group">
            <div class="label">City:</div>
            <input type="text" name="spot_field__city_address_center" class="arpr-form-text"
                value="<?=$spot_data['spot_field__city_address_center'][0];?>">
        </div>

        <div class="field-group">
            <div class="label">Zip code:</div>
            <input type="text" name="spot_field__zip_address_center" class="arpr-form-text"
                value="<?=$spot_data['spot_field__zip_address_center'][0];?>">
        </div>

        <div class="field-group">
            <div class="label">Téléphone:</div>
            <input type="tel" name="spot_field__tel_center" class="arpr-form-text"
                value="<?=$spot_data['spot_field__tel_center'][0];?>">
        </div>

        <div class="field-group">
            <div class="label">Adresse E-mail:</div>
            <input type="email" name="spot_field__email_center" class="arpr-form-text"
                value="<?=$spot_data['spot_field__email_center'][0];?>">
        </div>

        <div class="field-group">
            <div class="label">Site Web:</div>
            <input type="text" name="spot_field__website_center" class="arpr-form-text"
                value="<?=$spot_data['spot_field__website_center'][0];?>">
        </div>
    </div>

    <div class="column">
        <h3 class="title">Position: </h3>
        <div class="field-group">
            <div class="label">Latitude:</div>
            <input type="text" name="spot_field__lat" class="arpr-form-text"
                value="<?=$spot_data['spot_field__lat'][0];?>">
        </div>

        <div class="field-group">
            <div class="label">Longitude:</div>
            <input type="text" name="spot_field__lon" class="arpr-form-text"
                value="<?=$spot_data['spot_field__lon'][0];?>">
        </div>

        <div id="map-canvas" style="width:100%; height:450px;"></div>

        <?php

    if (isset($spot_data['spot_field__lat'][0]) && isset($spot_data['spot_field__lon'][0])) {

        $fromat_address = trim($spot_data['spot_field__lat'][0]) . '+' . trim($spot_data['spot_field__lon'][0]);
        // $fromat_address = str_replace(",","+",$fromat_address);
        $address_obj = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyDcnLKAxbtX2f_bAGN-e8x3eI_UktTiMbs&address=" . $fromat_address . "&sensor=false");
        $address_obj = json_decode($address_obj);
        $latitude = $address_obj->results[0]->geometry->location->lat;
        $longitude = $address_obj->results[0]->geometry->location->lng;
        ?>

        <script>
        var map;
        var lat = "<?php echo $latitude ?>";
        var lng = "<?php echo $longitude; ?>";

        function initialize() {

            var latlng = new google.maps.LatLng(lat, lng);

            var mapOptions = {
                zoom: 15,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }

            map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
            });

            marker.setMap(map);

        }
        // map-convas would be id of div you want to show your map in
        google.maps.event.addDomListener(window, 'load', initialize);
        </script>

        <?php
}
    ?>

    </div>


</div>

<?php
}

/**
 * Add custom Meta Box to Posts post type
 */
function spotslocatore_add_post_gallery()
{
    add_meta_box(
        'post_gallery',
        'Image Uploader',
        'spotslocatore_post_gallery_options',
        'spot', // here you can set post type name
        'normal',
        'core'
    );
}

/**
 * Print the Meta Box content
 */
function spotslocatore_post_gallery_options()
{
    global $post;
    $spot_gallery_data = get_post_meta($post->ID, 'spot_gallery_data', true);

    // Use nonce for verification
    wp_nonce_field(plugin_basename(__FILE__), 'noncename_so_14445904');?>

<div id="dynamic_form">

    <div id="field_wrap">
        <?php
if (isset($spot_gallery_data['image_url'])) {
        for ($i = 0; $i < count($spot_gallery_data['image_url']); $i++) {?>

        <div class="field_row">

            <div class="field_left">
                <div class="form_field">
                    <label>Image URL</label>
                    <input type="text" class="meta_image_url" name="gallery[image_url][]"
                        value="<?php esc_html_e($spot_gallery_data['image_url'][$i]);?>" />
                </div>
            </div>

            <div class="field_right">
                <div class="image_wrap">
                    <img src="<?php esc_html_e($spot_gallery_data['image_url'][$i]);?>" height="48" width=" 48" />
                </div>
            </div>

            <div class="field_right">
                <input class="button" type="button" value="Choose File" onclick="add_image(this)" /><br />
                <input class="button" type="button" value="Remove" onclick="remove_field(this)" />
            </div>

            <div class="clear">
            </div>
        </div>

        <?php
}
    }
    ?>
    </div>

    <div style="display:none" id="master-row">
        <div class="field_row">
            <div class="field_left">
                <div class="form_field">
                    <label>Image URL</label>
                    <input class="meta_image_url" value="" type="text" name="gallery[image_url][]" />
                </div>
            </div>
            <div class="field_right">
                <div class="image_wrap">
                </div>
            </div>
            <div class="field_right">
                <input type="button" class="button" value="Choose File" onclick="add_image(this)" />
                <br />
                <input class="button" type="button" value="Remove" onclick="remove_field(this)" />
            </div>
            <div class="clear"></div>
        </div>
    </div>

    <div id="add_field_row">
        <input class="button" type="button" value="Add Field" onclick="add_field_row();" />
    </div>

</div>

<?php
}

/**
 * Print styles and scripts
 */
function spotslocatore_print_scripts()
{
    // Check for correct post_type
    global $post;
    // here you can set post type name
    if ('spot' != $post->post_type) {
        return;
    }

    ?>
<style type="text/css">
.field_left {
    float: left;
    width: 50%;
}

.field_right {
    float: right;
    margin: 0px 32px;
}

.image_wrap {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 90px;
    height: 90px;
    object-fit: contain;
}

.image_wrap img {
    width: 100%;
    max-height: 100%;
    object-fit: contain;
}

.field_right .button {
    width: 150px;
    margin-bottom: 8px;
}

.clear {
    clear: both;
}

#dynamic_form input[type=text] {
    width: 100%;
    border-radius: 2px;
    margin: 8px 0;
    height: 40px;
    line-height: 40px;
}

#dynamic_form .field_row {
    border: 1px solid #eeeeee;
    margin-bottom: 10px;
    padding: 10px;
}

#dynamic_form label {
    padding: 8px 0;
    font-size: 16px;
}
</style>

<script type="text/javascript">
function add_image(obj) {
    var parent = jQuery(obj).parent().parent('div.field_row');
    var inputField = jQuery(parent).find("input.meta_image_url ");

    tb_show('', 'media-upload.php?TB_iframe=true');

    window.send_to_editor = function(html) {
        console.log(html);
        // var url = jQuery(html).find('img').attr('src');
        var url = jQuery(html).attr('src');
        inputField.val(url);
        jQuery(parent).find("div.image_wrap ").html('<img src="' + url + '" />');
        // inputField.closest('p').prev('.awdMetaImage').html('<img height=120 width=120 src="'+url+'"/><p>URL: '+ url + '</p>');
        tb_remove();
    };

    return false;
}

function remove_field(obj) {
    var parent = jQuery(obj).parent().parent();
    //console.log(parent)
    parent.remove();
}

function add_field_row() {
    var row = jQuery('#master-row').html();
    jQuery(row).appendTo('#field_wrap');
}
</script>
<?php
}

/**
 * Save post action, process fields
 */
function spotslocatore_update_post_gallery($post_id, $post_object)
{

    // Doing revision, exit earlier **can be removed**
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Doing revision, exit earlier
    if ('revision' == $post_object->post_type) {
        return;
    }

    // Verify authenticity
    if (!wp_verify_nonce($_POST['noncename_so_14445904'], plugin_basename(__FILE__))) {
        return;
    }

    // Correct post type
    if ('spot' != $_POST['post_type']) // here you can set post type name
    {
        return;
    }

    if ($_POST['gallery']) {
        // Build array for saving post meta
        $spot_gallery_data = array();
        for ($i = 0; $i < count($_POST['gallery']['image_url']); $i++) {
            if ("" != $_POST['gallery']['image_url'][$i]) {
                $spot_gallery_data['image_url'][] = $_POST['gallery']['image_url'][$i];
            }
        }

        if ($spot_gallery_data) {
            update_post_meta($post_id, 'spot_gallery_data', $spot_gallery_data);
        } else {
            delete_post_meta($post_id, 'spot_gallery_data');
        }

    }
    // Nothing received, all fields are empty, delete option
    else {
        delete_post_meta($post_id, 'spot_gallery_data');
    }
}