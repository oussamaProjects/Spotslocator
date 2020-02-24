<?php
function add_export_button() {
    $screen = get_current_screen();
    
    if (isset($screen->parent_file) && ('edit.php?post_type=spot' == $screen->parent_file)) {
        ?>
        <input type="submit" name="export_all_posts" id="export_all_posts" class="button button-primary" value="Export">
        <?php
    }
}
add_action( 'manage_posts_extra_tablenav', 'add_export_button');

function func_export_all_posts() {
    if(isset($_GET['export_all_posts'])) {
        $arg = array(
                'post_type' => 'spot',
                'post_status' => array('publish', 'pending', 'draft', 'private'),
                'posts_per_page' => -1,
            );

        global $post;
        $spots = get_posts($arg);
        if ($spots) {
            // die(var_dump($spots));

            header('Content-type: text/csv');
            header('Content-Disposition: attachment; filename="spots.csv"');
            header('Pragma: no-cache');
            header('Expires: 0');

            $file = fopen('php://output', 'w');

            fputcsv($file, array(
                "Date d'inscription",
                'Prénom', 'Nom', 'Date de naissance', 'Adresse E-mail', 'Téléphone privé', 'Téléphone portable', 'Rue et Numéro', "Complement d'adresse", 'NIP', 'Ville', 'Profession', 'Employeur', 'Date de retraite prévisible', 'Recevoir les supports des cours en format papier', 'Message', 'Accompagné',
                'Prénom (compagnon)', 'Nom (compagnon)', 'Date de naissance (compagnon)', 'Adresse E-mail (compagnon)', 'Téléphone privé (compagnon)', 'Téléphone portable (compagnon)', 'Rue et Numéro (compagnon)', "Complement d'adresse (compagnon)", 'NIP (compagnon)', 'Ville (compagnon)', 'Profession (compagnon)', 'Employeur (compagnon)', 'Date de retraite prévisible (compagnon)', 'Recevoir les supports des cours en format papier (compagnon)', 'Cours'
            ));

            foreach ($spots as $post) {
                setup_postdata($post);
                $inscription_data = get_post_meta($post->ID);
                fputcsv($file, array(
                    $post->post_date,
                    $inscription_data['spot_field__prenom'][0],
                    $inscription_data['spot_field__nom'][0],
                    $inscription_data['spot_field__date_naiss'][0],
                    $inscription_data['spot_field__email'][0],
                    $inscription_data['spot_field__tel_prive'][0],
                    $inscription_data['spot_field__tel_portable'][0],
                    $inscription_data['spot_field__adr_rue'][0],
                    $inscription_data['spot_field__adr_complement'][0],
                    $inscription_data['spot_field__adr_nip'][0],
                    $inscription_data['spot_field__adr_ville'][0],
                    $inscription_data['spot_field__profession'][0],
                    $inscription_data['spot_field__employeur'][0],
                    $inscription_data['spot_field__date_retraite'][0],
                    $inscription_data['spot_field__recevoir_support_papier'][0] ? 'Oui' : 'Non',
                    $inscription_data['spot_field__message'][0],
                    $inscription_data['spot_field__accompagne'][0] ? 'Oui' : 'Non',

                    $inscription_data['spot_field__acc_prenom'][0],
                    $inscription_data['spot_field__acc_nom'][0],
                    $inscription_data['spot_field__acc_date_naiss'][0],
                    $inscription_data['spot_field__acc_email'][0],
                    $inscription_data['spot_field__acc_tel_prive'][0],
                    $inscription_data['spot_field__acc_tel_portable'][0],
                    $inscription_data['spot_field__acc_adr_rue'][0],
                    $inscription_data['spot_field__acc_adr_complement'][0],
                    $inscription_data['spot_field__acc_adr_nip'][0],
                    $inscription_data['spot_field__acc_adr_ville'][0],
                    $inscription_data['spot_field__acc_profession'][0],
                    $inscription_data['spot_field__acc_employeur'][0],
                    $inscription_data['spot_field__acc_date_retraite'][0],
                    $inscription_data['spot_field__acc_recevoir_support_papier'][0] ? 'Oui' : 'Non',
                    
                    preg_replace( "/\r|\n/", "", implode(' | ', unserialize($inscription_data['spot_field__cours'][0])) )
                ));
            }

            exit();
        }
    }
}
add_action( 'init', 'func_export_all_posts' );
