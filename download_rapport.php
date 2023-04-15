<?php
require_once('includes/load.php');
if (!$session->isUserLoggedIn()) {
    redirect('login', false);
}
$user = current_user();
$id = $_GET['id'];
if (!$id) {
    $session->msg("d", "Identifiant manquant.");
    redirect("rapport");
} else {
    $rapport = find_by_id('rapports', $id);
    if ($rapport['user'] !== $user['email']) {
        redirect("rapport");
    }
}

function prepare($texte)
{
    return str_replace("\\r\\n", "<w:br/>", $texte);
}
$acte_1 = 'aspirer les voies aériennes supérieures chez un patient sans voie
respiratoire artificielle';
function join_actes($actes) {
    $acte_separer = explode(':', $actes);
    foreach($acte_separer as $acte){
        $acte_1 = 'P01 : aspirer les voies aériennes supérieures chez un patient sans voie respiratoire artificielle';
        if($acte == '1'){
            return $acte_1;
        }
    }
}


$find_mission_1_smur = trouver_mission_smur($id, "1");
$find_mission_2_smur = trouver_mission_smur($id, "2");
$find_mission_3_smur = trouver_mission_smur($id, "3");
$find_mission_4_smur = trouver_mission_smur($id, "4");
$find_mission_5_smur = trouver_mission_smur($id, "5");
$data_smur = array(
    "smur_titre_1" => base64_decode($find_mission_1_smur['title']),
    "smur_date_heure_1" => base64_decode($find_mission_1_smur['date_heure']),
    "smur_num_mission_1" => $find_mission_1_smur['num_mission'],
    "smur_motif_1" => base64_decode($find_mission_1_smur['motif']),
    "smur_bilan_cir_1" => prepare($find_mission_1_smur['bilan_cir']),
    "smur_sexe_1" => base64_decode($find_mission_1_smur['sexe']),
    "smur_age_1" => $find_mission_1_smur['age'],
    "smur_antcd_1" => base64_decode($find_mission_1_smur['antcd']),
    "smur_sss_1" => prepare($find_mission_1_smur['SSS']),
    "smur_EPADONO_1" => $find_mission_1_smur['EPADONO'],
    "smur_position_1" => prepare($find_mission_1_smur['position']),
    "smur_airways_ql_1" => prepare($find_mission_1_smur['airways_ql']),
    "smur_breathing_ql_1" => prepare($find_mission_1_smur['breathing_ql']),
    "smur_circulation_ql_1" => prepare($find_mission_1_smur['circulation_ql']),
    "smur_a_1" => prepare($find_mission_1_smur['a']),
    "smur_b_1" => prepare($find_mission_1_smur['b']),
    "smur_c_1" => prepare($find_mission_1_smur['c']),
    "smur_d_1" => prepare($find_mission_1_smur['d']),
    "smur_e_1" => prepare($find_mission_1_smur['e']),
    "smur_actes_1" => prepare($find_mission_1_smur['actes']),
    "smur_reevalution_1" => prepare($find_mission_1_smur['reevalution']),
    "smur_autre_moyen_1" => prepare($find_mission_1_smur['autre_moyen']),
    "smur_actes_stagiaire_1" => prepare($find_mission_1_smur['actes_stagiaire']),
    "smur_surveillance_1" => prepare($find_mission_1_smur['surveillance']),
    "smur_diff_1" => prepare($find_mission_1_smur['diff']),
    "smur_eval_1" => prepare($find_mission_1_smur['eval']),
    "smur_patho_1" => prepare($find_mission_1_smur['patho']),
    "smur_ressenti_1" => prepare($find_mission_1_smur['ressenti']), // ambu 1
    "smur_titre_2" => base64_decode($find_mission_2_smur['title']),
    "smur_date_heure_2" => base64_decode($find_mission_2_smur['date_heure']),
    "smur_num_mission_2" => $find_mission_2_smur['num_mission'],
    "smur_motif_2" => base64_decode($find_mission_2_smur['motif']),
    "smur_bilan_cir_2" => prepare($find_mission_2_smur['bilan_cir']),
    "smur_sexe_2" => base64_decode($find_mission_2_smur['sexe']),
    "smur_age_2" => $find_mission_2_smur['age'],
    "smur_antcd_2" => base64_decode($find_mission_2_smur['antcd']),
    "smur_sss_2" => prepare($find_mission_2_smur['SSS']),
    "smur_EPADONO_2" => $find_mission_2_smur['EPADONO'],
    "smur_position_2" => prepare($find_mission_2_smur['position']),
    "smur_airways_ql_2" => prepare($find_mission_2_smur['airways_ql']),
    "smur_breathing_ql_2" => prepare($find_mission_2_smur['breathing_ql']),
    "smur_circulation_ql_2" => prepare($find_mission_2_smur['circulation_ql']),
    "smur_a_2" => prepare($find_mission_2_smur['a']),
    "smur_b_2" => prepare($find_mission_2_smur['b']),
    "smur_c_2" => prepare($find_mission_2_smur['c']),
    "smur_d_2" => prepare($find_mission_2_smur['d']),
    "smur_e_2" => prepare($find_mission_2_smur['e']),
    "smur_actes_2" => prepare($find_mission_2_smur['actes']),
    "smur_reevalution_2" => prepare($find_mission_2_smur['reevalution']),
    "smur_autre_moyen_2" => prepare($find_mission_2_smur['autre_moyen']),
    "smur_actes_stagiaire_2" => prepare($find_mission_2_smur['actes_stagiaire']),
    "smur_surveillance_2" => prepare($find_mission_2_smur['surveillance']),
    "smur_diff_2" => prepare($find_mission_2_smur['diff']),
    "smur_eval_2" => prepare($find_mission_2_smur['eval']),
    "smur_patho_2" => prepare($find_mission_2_smur['patho']),
    "smur_ressenti_2" => prepare($find_mission_2_smur['ressenti']), // ambu 2
    "smur_titre_3" => base64_decode($find_mission_3_smur['title']),
    "smur_date_heure_3" => base64_decode($find_mission_3_smur['date_heure']),
    "smur_num_mission_3" => $find_mission_3_smur['num_mission'],
    "smur_motif_3" => base64_decode($find_mission_3_smur['motif']),
    "smur_bilan_cir_3" => prepare($find_mission_3_smur['bilan_cir']),
    "smur_sexe_3" => base64_decode($find_mission_3_smur['sexe']),
    "smur_age_3" => $find_mission_3_smur['age'],
    "smur_antcd_3" => base64_decode($find_mission_3_smur['antcd']),
    "smur_sss_3" => prepare($find_mission_3_smur['SSS']),
    "smur_EPADONO_3" => $find_mission_3_smur['EPADONO'],
    "smur_position_3" => prepare($find_mission_3_smur['position']),
    "smur_airways_ql_3" => prepare($find_mission_3_smur['airways_ql']),
    "smur_breathing_ql_3" => prepare($find_mission_3_smur['breathing_ql']),
    "smur_circulation_ql_3" => prepare($find_mission_3_smur['circulation_ql']),
    "smur_a_3" => prepare($find_mission_3_smur['a']),
    "smur_b_3" => prepare($find_mission_3_smur['b']),
    "smur_c_3" => prepare($find_mission_3_smur['c']),
    "smur_d_3" => prepare($find_mission_3_smur['d']),
    "smur_e_3" => prepare($find_mission_3_smur['e']),
    "smur_actes_3" => prepare($find_mission_3_smur['actes']),
    "smur_reevalution_3" => prepare($find_mission_3_smur['reevalution']),
    "smur_autre_moyen_3" => prepare($find_mission_3_smur['autre_moyen']),
    "smur_actes_stagiaire_3" => prepare($find_mission_3_smur['actes_stagiaire']),
    "smur_surveillance_3" => prepare($find_mission_3_smur['surveillance']),
    "smur_diff_3" => prepare($find_mission_3_smur['diff']),
    "smur_eval_3" => prepare($find_mission_3_smur['eval']),
    "smur_patho_3" => prepare($find_mission_3_smur['patho']),
    "smur_ressenti_3" => prepare($find_mission_3_smur['ressenti']), // ambu 3
    "smur_titre_4" => base64_decode($find_mission_4_smur['title']),
    "smur_date_heure_4" => base64_decode($find_mission_4_smur['date_heure']),
    "smur_num_mission_4" => $find_mission_4_smur['num_mission'],
    "smur_motif_4" => base64_decode($find_mission_4_smur['motif']),
    "smur_bilan_cir_4" => prepare($find_mission_4_smur['bilan_cir']),
    "smur_sexe_4" => base64_decode($find_mission_4_smur['sexe']),
    "smur_age_4" => $find_mission_4_smur['age'],
    "smur_antcd_4" => base64_decode($find_mission_4_smur['antcd']),
    "smur_sss_4" => prepare($find_mission_4_smur['SSS']),
    "smur_EPADONO_4" => $find_mission_4_smur['EPADONO'],
    "smur_position_4" => prepare($find_mission_4_smur['position']),
    "smur_airways_ql_4" => prepare($find_mission_4_smur['airways_ql']),
    "smur_breathing_ql_4" => prepare($find_mission_4_smur['breathing_ql']),
    "smur_circulation_ql_4" => prepare($find_mission_4_smur['circulation_ql']),
    "smur_a_4" => prepare($find_mission_4_smur['a']),
    "smur_b_4" => prepare($find_mission_4_smur['b']),
    "smur_c_4" => prepare($find_mission_4_smur['c']),
    "smur_d_4" => prepare($find_mission_4_smur['d']),
    "smur_e_4" => prepare($find_mission_4_smur['e']),
    "smur_actes_4" => prepare($find_mission_4_smur['actes']),
    "smur_reevalution_4" => prepare($find_mission_4_smur['reevalution']),
    "smur_autre_moyen_4" => prepare($find_mission_4_smur['autre_moyen']),
    "smur_actes_stagiaire_4" => prepare($find_mission_4_smur['actes_stagiaire']),
    "smur_surveillance_4" => prepare($find_mission_4_smur['surveillance']),
    "smur_diff_4" => prepare($find_mission_4_smur['diff']),
    "smur_eval_4" => prepare($find_mission_4_smur['eval']),
    "smur_patho_4" => prepare($find_mission_4_smur['patho']),
    "smur_ressenti_4" => prepare($find_mission_4_smur['ressenti']), // ambu 4
    "smur_titre_5" => base64_decode($find_mission_5_smur['title']),
    "smur_date_heure_5" => base64_decode($find_mission_5_smur['date_heure']),
    "smur_num_mission_5" => $find_mission_5_smur['num_mission'],
    "smur_motif_5" => base64_decode($find_mission_5_smur['motif']),
    "smur_bilan_cir_5" => prepare($find_mission_5_smur['bilan_cir']),
    "smur_sexe_5" => base64_decode($find_mission_5_smur['sexe']),
    "smur_age_5" => $find_mission_5_smur['age'],
    "smur_antcd_5" => base64_decode($find_mission_5_smur['antcd']),
    "smur_sss_5" => prepare($find_mission_5_smur['SSS']),
    "smur_EPADONO_5" => $find_mission_5_smur['EPADONO'],
    "smur_position_5" => prepare($find_mission_5_smur['position']),
    "smur_airways_ql_5" => prepare($find_mission_5_smur['airways_ql']),
    "smur_breathing_ql_5" => prepare($find_mission_5_smur['breathing_ql']),
    "smur_circulation_ql_5" => prepare($find_mission_5_smur['circulation_ql']),
    "smur_a_5" => prepare($find_mission_5_smur['a']),
    "smur_b_5" => prepare($find_mission_5_smur['b']),
    "smur_c_5" => prepare($find_mission_5_smur['c']),
    "smur_d_5" => prepare($find_mission_5_smur['d']),
    "smur_e_5" => prepare($find_mission_5_smur['e']),
    "smur_actes_5" => prepare($find_mission_5_smur['actes']),
    "smur_reevalution_5" => prepare($find_mission_5_smur['reevalution']),
    "smur_autre_moyen_5" => prepare($find_mission_5_smur['autre_moyen']),
    "smur_actes_stagiaire_5" => prepare($find_mission_5_smur['actes_stagiaire']),
    "smur_surveillance_5" => prepare($find_mission_5_smur['surveillance']),
    "smur_diff_5" => prepare($find_mission_5_smur['diff']),
    "smur_eval_5" => prepare($find_mission_5_smur['eval']),
    "smur_patho_5" => prepare($find_mission_5_smur['patho']),
    "smur_ressenti_5" => prepare($find_mission_5_smur['ressenti']) // ambu 5
);

$find_mission_1 = trouver_mission($id, "1");
$find_mission_2 = trouver_mission($id, "2");
$find_mission_3 = trouver_mission($id, "3");
$find_mission_4 = trouver_mission($id, "4");
$find_mission_5 = trouver_mission($id, "5");
$data_ambu = array(
    "titre_1" => base64_decode($find_mission_1['title']),
    "date_heure_1" => base64_decode($find_mission_1['date_heure']),
    "num_mission_1" => $find_mission_1['num_mission'],
    "motif_1" => base64_decode($find_mission_1['motif']),
    "bilan_cir_1" => prepare($find_mission_1['bilan_cir']),
    "sexe_1" => base64_decode($find_mission_1['sexe']),
    "age_1" => $find_mission_1['age'],
    "antcd_1" => base64_decode($find_mission_1['antcd']),
    "sss_1" => prepare($find_mission_1['SSS']),
    "EPADONO_1" => $find_mission_1['EPADONO'],
    "position_1" => prepare($find_mission_1['position']),
    "airways_ql_1" => prepare($find_mission_1['airways_ql']),
    "breathing_ql_1" => prepare($find_mission_1['breathing_ql']),
    "circulation_ql_1" => prepare($find_mission_1['circulation_ql']),
    "a_1" => prepare($find_mission_1['a']),
    "b_1" => prepare($find_mission_1['b']),
    "c_1" => prepare($find_mission_1['c']),
    "d_1" => prepare($find_mission_1['d']),
    "e_1" => prepare($find_mission_1['e']),
    "actes_1" => join_actes($find_mission_1['actes']),
    "reevalution_1" => prepare($find_mission_1['reevalution']),
    "autre_moyen_1" => prepare($find_mission_1['autre_moyen']),
    "actes_stagiaire_1" => prepare($find_mission_1['actes_stagiaire']),
    "surveillance_1" => prepare($find_mission_1['surveillance']),
    "diff_1" => prepare($find_mission_1['diff']),
    "eval_1" => prepare($find_mission_1['eval']),
    "patho_1" => prepare($find_mission_1['patho']),
    "ressenti_1" => prepare($find_mission_1['ressenti']), // ambu 1
    "titre_2" => base64_decode($find_mission_2['title']),
    "date_heure_2" => base64_decode($find_mission_2['date_heure']),
    "num_mission_2" => $find_mission_2['num_mission'],
    "motif_2" => base64_decode($find_mission_2['motif']),
    "bilan_cir_2" => prepare($find_mission_2['bilan_cir']),
    "sexe_2" => base64_decode($find_mission_2['sexe']),
    "age_2" => $find_mission_2['age'],
    "antcd_2" => base64_decode($find_mission_2['antcd']),
    "sss_2" => prepare($find_mission_2['SSS']),
    "EPADONO_2" => $find_mission_2['EPADONO'],
    "position_2" => prepare($find_mission_2['position']),
    "airways_ql_2" => prepare($find_mission_2['airways_ql']),
    "breathing_ql_2" => prepare($find_mission_2['breathing_ql']),
    "circulation_ql_2" => prepare($find_mission_2['circulation_ql']),
    "a_2" => prepare($find_mission_2['a']),
    "b_2" => prepare($find_mission_2['b']),
    "c_2" => prepare($find_mission_2['c']),
    "d_2" => prepare($find_mission_2['d']),
    "e_2" => prepare($find_mission_2['e']),
    "actes_2" => prepare($find_mission_2['actes']),
    "reevalution_2" => prepare($find_mission_2['reevalution']),
    "autre_moyen_2" => prepare($find_mission_2['autre_moyen']),
    "actes_stagiaire_2" => prepare($find_mission_2['actes_stagiaire']),
    "surveillance_2" => prepare($find_mission_2['surveillance']),
    "diff_2" => prepare($find_mission_2['diff']),
    "eval_2" => prepare($find_mission_2['eval']),
    "patho_2" => prepare($find_mission_2['patho']),
    "ressenti_2" => prepare($find_mission_2['ressenti']), // ambu 2
    "titre_3" => base64_decode($find_mission_3['title']),
    "date_heure_3" => base64_decode($find_mission_3['date_heure']),
    "num_mission_3" => $find_mission_3['num_mission'],
    "motif_3" => base64_decode($find_mission_3['motif']),
    "bilan_cir_3" => prepare($find_mission_3['bilan_cir']),
    "sexe_3" => base64_decode($find_mission_3['sexe']),
    "age_3" => $find_mission_3['age'],
    "antcd_3" => base64_decode($find_mission_3['antcd']),
    "sss_3" => prepare($find_mission_3['SSS']),
    "EPADONO_3" => $find_mission_3['EPADONO'],
    "position_3" => prepare($find_mission_3['position']),
    "airways_ql_3" => prepare($find_mission_3['airways_ql']),
    "breathing_ql_3" => prepare($find_mission_3['breathing_ql']),
    "circulation_ql_3" => prepare($find_mission_3['circulation_ql']),
    "a_3" => prepare($find_mission_3['a']),
    "b_3" => prepare($find_mission_3['b']),
    "c_3" => prepare($find_mission_3['c']),
    "d_3" => prepare($find_mission_3['d']),
    "e_3" => prepare($find_mission_3['e']),
    "actes_3" => prepare($find_mission_3['actes']),
    "reevalution_3" => prepare($find_mission_3['reevalution']),
    "autre_moyen_3" => prepare($find_mission_3['autre_moyen']),
    "actes_stagiaire_3" => prepare($find_mission_3['actes_stagiaire']),
    "surveillance_3" => prepare($find_mission_3['surveillance']),
    "diff_3" => prepare($find_mission_3['diff']),
    "eval_3" => prepare($find_mission_3['eval']),
    "patho_3" => prepare($find_mission_3['patho']),
    "ressenti_3" => prepare($find_mission_3['ressenti']), // ambu 3
    "titre_4" => base64_decode($find_mission_4['title']),
    "date_heure_4" => base64_decode($find_mission_4['date_heure']),
    "num_mission_4" => $find_mission_4['num_mission'],
    "motif_4" => base64_decode($find_mission_4['motif']),
    "bilan_cir_4" => prepare($find_mission_4['bilan_cir']),
    "sexe_4" => base64_decode($find_mission_4['sexe']),
    "age_4" => $find_mission_4['age'],
    "antcd_4" => base64_decode($find_mission_4['antcd']),
    "sss_4" => prepare($find_mission_4['SSS']),
    "EPADONO_4" => $find_mission_4['EPADONO'],
    "position_4" => prepare($find_mission_4['position']),
    "airways_ql_4" => prepare($find_mission_4['airways_ql']),
    "breathing_ql_4" => prepare($find_mission_4['breathing_ql']),
    "circulation_ql_4" => prepare($find_mission_4['circulation_ql']),
    "a_4" => prepare($find_mission_4['a']),
    "b_4" => prepare($find_mission_4['b']),
    "c_4" => prepare($find_mission_4['c']),
    "d_4" => prepare($find_mission_4['d']),
    "e_4" => prepare($find_mission_4['e']),
    "actes_4" => prepare($find_mission_4['actes']),
    "reevalution_4" => prepare($find_mission_4['reevalution']),
    "autre_moyen_4" => prepare($find_mission_4['autre_moyen']),
    "actes_stagiaire_4" => prepare($find_mission_4['actes_stagiaire']),
    "surveillance_4" => prepare($find_mission_4['surveillance']),
    "diff_4" => prepare($find_mission_4['diff']),
    "eval_4" => prepare($find_mission_4['eval']),
    "patho_4" => prepare($find_mission_4['patho']),
    "ressenti_4" => prepare($find_mission_4['ressenti']), // ambu 4
    "titre_5" => base64_decode($find_mission_5['title']),
    "date_heure_5" => base64_decode($find_mission_5['date_heure']),
    "num_mission_5" => $find_mission_5['num_mission'],
    "motif_5" => base64_decode($find_mission_5['motif']),
    "bilan_cir_5" => prepare($find_mission_5['bilan_cir']),
    "sexe_5" => base64_decode($find_mission_5['sexe']),
    "age_5" => $find_mission_5['age'],
    "antcd_5" => base64_decode($find_mission_5['antcd']),
    "sss_5" => prepare($find_mission_5['SSS']),
    "EPADONO_5" => $find_mission_5['EPADONO'],
    "position_5" => prepare($find_mission_5['position']),
    "airways_ql_5" => prepare($find_mission_5['airways_ql']),
    "breathing_ql_5" => prepare($find_mission_5['breathing_ql']),
    "circulation_ql_5" => prepare($find_mission_5['circulation_ql']),
    "a_5" => prepare($find_mission_5['a']),
    "b_5" => prepare($find_mission_5['b']),
    "c_5" => prepare($find_mission_5['c']),
    "d_5" => prepare($find_mission_5['d']),
    "e_5" => prepare($find_mission_5['e']),
    "actes_5" => prepare($find_mission_5['actes']),
    "reevalution_5" => prepare($find_mission_5['reevalution']),
    "autre_moyen_5" => prepare($find_mission_5['autre_moyen']),
    "actes_stagiaire_5" => prepare($find_mission_5['actes_stagiaire']),
    "surveillance_5" => prepare($find_mission_5['surveillance']),
    "diff_5" => prepare($find_mission_5['diff']),
    "eval_5" => prepare($find_mission_5['eval']),
    "patho_5" => prepare($find_mission_5['patho']),
    "ressenti_5" => prepare($find_mission_5['ressenti']) // ambu 5
);

$data_rapport = array(
    "nom_prenom" => $rapport['nom'],
    "service" => $rapport['service'],
    "annee" => $rapport['annee']
);

require_once 'vendor/autoload.php';

$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(realpath('./rapport.docx'));
$templateProcessor->setValues($data_rapport);
$templateProcessor->setValues($data_ambu);
$templateProcessor->setValues($data_smur);
$pathToSave = './rapport_AMU-Redac.docx';
$templateProcessor->saveAs($pathToSave);
$docxName = 'rapport_AMU-Redac.docx';

header('Content-type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment; filename="' . $docxName . '"');
readfile($pathToSave);
unlink($pathToSave);
