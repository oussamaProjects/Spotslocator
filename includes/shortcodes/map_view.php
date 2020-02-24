<?php
function map_view($atts)
{

    ob_start();?>

<article id="mapfindspots" class="fr">
    <div class="container ">
        <div class="frenchmap desc">
            Entrez une ville, un département ou un code postal dans le champ ci-dessous, ou
            sélectionnez un département directement sur la carte
        </div>

        <div id="map_error_msg"></div>

        <input name="google_loc" placeholder="Indiquez un lieu" type="text" class=" form-control" id="google_loc"
            data-required="1" />
        <div style="float:none;margin:0 auto;" id="map" data-trainingcenters=""></div>

        <div id="training_center_list">
            <p class="center_number">centres trouvés.</p>
            <p class="oversized_results">Veuillez zoomer pour afficher la liste.</p>
        </div>

        <div id="dialog_training_center_detail" title="" class="mydialog">
            <div class="box-close">
                <div class="under-box-close">
                    <a class="close" data-dismiss="modal"
                        onclick="$('#dialog_training_center_detail').dialog('close');">
                        <span id="" aria-hidden="true">&times;</span>
                    </a>
                </div>
            </div>

            <div class="content_area">
                <p class="messageadmin" id="dialog_training_center_detail_error"></p>
                <div class="trainingcentersdetails">

                    <div class="col-md-11">

                        <div class="con">
                            <p class="ref"><strong>Référent: </strong></p>
                            <p class="nom_ref"></p>
                            <p class="tel_ref"></p>
                            <p class="email_ref"></p>
                        </div>

                        <div class="adr">
                            <p class="address"><strong>Adresse: </strong></p>
                            <p>
                                <span class="street"></span>
                                <span class="zispan"></span>
                                <span class="cit"></span>
                            </p>
                            <span class="see_map_g">zoomer sur la carte</span>
                        </div>

                        <div class="center">
                            <p class="address"> <strong>center: </strong> </p>
                            <p class="nom_center"></p>
                            <p class="tel_center"></p>
                            <div class="website_center"><a href="#" target="_blank">Website</a></div>
                        </div>

                    </div>

                    <div class="col-md-3"><a class="logo_url" target="_blank"> <img src="#" class="logo" alt=""> </a>
                    </div>

                    <div class="col-md-12"><a href="#">Contacer le centre </a>
                    </div>

                </div>
                <input type="hidden" name="postback_message" value="" />
            </div>
            <div class="button_area">

                <p class="text"></p>

            </div>
            <div class="image-slide-container">
            </div>
        </div>



        <input type="hidden" name="map_place" value="" id="map_place" />
        <input type="hidden" name="zoom" value="zoomer sur la carte" id="zoom" />
    </div>
</article>



<?php
$map = ob_get_clean();
    return $map;
}