<?php
$pagetitre = "Analyse pratique de la mission";
$footerdark = true;
require_once('includes/load.php');
if (!$session->isUserLoggedIn()) {
    redirect('login', false);
}
$user = current_user();
$id = htmlspecialchars($_GET['id']);
$mission = htmlspecialchars($_GET['mission']);
$exist_mission = false;
if (!$id) {
    $session->msg("d", "Identifiant manquant.");
    redirect("rapport");
} else {
    if ($mission) {
        $rapport = find_by_id('rapports', $id);
        if ($rapport['user'] !== $user['email']) {
            redirect("rapport");
        }
        $find_mission = trouver_mission($id, $mission);
        if ($find_mission) {
            $exist_mission = true;
        }
    } else {
        $session->msg("d", "Identifiant de mission manquant.");
        redirect("rapport");
    }
}
$database = new MySqli_DB();

if (isset($_POST['sauv_1'])) {

    if (empty($errors)) {
        if (!empty($_POST['proc'])){
            $editor   = remove_junk($db->escape(implode(":", $_POST['proc'])));
        } else {
            $editor = "0";
        }
        $op   = remove_junk($db->escape($_POST['ordre']));
        $editor1   = remove_junk($db->escape($_POST['editor1']));
        $editor2   = remove_junk($db->escape($_POST['editor2']));
        $editor3   = remove_junk($db->escape($_POST['editor3']));
        $editor4   = remove_junk($db->escape($_POST['editor4']));
        $query = $database->db_prepare("INSERT INTO missions_ambu (id_rapports,id_mission,actes,op,reevalution,autre_moyen,actes_stagiaire,surveillance) VALUES (?,?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE actes = ?, op = ?,reevalution = ?, autre_moyen = ?, actes_stagiaire = ?, surveillance = ?");
        $query->bind_param("ssssssssssssss", $id, $mission, $editor, $op,$editor1, $editor2, $editor3, $editor4, $editor, $op, $editor1, $editor2, $editor3, $editor4);
        if ($query->execute()) {
            $session->msg('s', `Mission sauvegardée`);
            redirect("view_mission-5?id=$id&mission=$mission&sauv=ok", false);
        } else {
            $session->msg('d', "Ajout du rapport échoué");
            redirect(`rapport`);
        }
    } else {
        $session->msg("d", $errors);
        redirect(`view_mission-4?id=$id&mission=$mission`);
    }
}

include_once('./libs/header.php'); ?>
<?php if (!empty($_GET['sauv'])) {
    if ($_GET['sauv'] == "ok") {
        echo display2_msg("success", "Sauvegardé avec succes !");
    }
} ?>
<section class="bg-light pt-5 pb-10">
    <div class="container">
        <div class="row gx-5">
            <div class="col-lg-4 col-xl-3 mb-5">
                <div class="card">
                    <div class="list-group list-group-flush small">
                        <a class="list-group-item list-group-item-action p-3" href="view_mission?id=<?php echo $id ?>&mission=<?php echo $mission ?>">
                            <i class="far fa-newspaper fa-fw me-2 text-gray-400"></i>
                            Introduction de mission
                        </a>
                        <a class="list-group-item list-group-item-action p-3" href="view_mission-2?id=<?php echo $id ?>&mission=<?php echo $mission ?>">
                            <i class="fas fa-tree fa-fw me-2 text-gray-400"></i>
                            SSS - Quick Look
                        </a>
                        <a class="list-group-item list-group-item-action p-3" href="view_mission-3?id=<?php echo $id ?>&mission=<?php echo $mission ?>">
                            <i class="fas fa-cog fa-fw me-2 text-gray-400"></i>
                            ABCDE
                        </a>
                        <a class="list-group-item list-group-item-action p-3" href="view_mission-4?id=<?php echo $id ?>&mission=<?php echo $mission ?>">
                            <i class="fas fa-briefcase fa-fw me-2 text-gray-400"></i>
                            Analyse pratique de la mission
                        </a>
                        <a class="list-group-item list-group-item-action p-3" href="view_mission-5?id=<?php echo $id ?>&mission=<?php echo $mission ?>">
                            <i class="fas fa-chalkboard-teacher fa-fw me-2 text-gray-400"></i>
                            Analyse et recherche
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xl-9">
                <form method="post" action="view_mission-4?id=<?php echo $id; ?>&mission=<?php echo $mission; ?>">
                    <div class="d-flex align-items-center justify-content-between flex-column flex-md-row">
                        <h2 class="mb-0">Analyse pratique de la mission</h2>
                        <button class="btn btn-secondary btn-m me-2" name="sauv_1" type="submit">Sauvegarder et suivant</button>
                    </div>
                    <hr class="mb-4" />
                    <div class="card mb-5">
                        <div class="card-header">11# Actes ambulanciers réalisés sur place (en référence aux OP et procédures)</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="proc[]" value="1">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">P 01 aspirer les voies aériennes supérieures chez un patient sans voie respiratoire artificielle</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="proc[]" value="2">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">P 02 aspirer les voies aériennes chez un patient avec une voie respiratoire artificielle</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" name="proc[]" value="3">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">P 03 utiliser un saturomètre</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="4">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 04 administrer de l’oxygène</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="5">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 05 utiliser un masque de poche </label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="proc[]" value="6">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">P 06 placer une canule de mayo</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="proc[]" value="7">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">p 07 ventiler à l’aide d’un ballon de réanimation et d’un masque</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" name="proc[]" value="8">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">P 08 dégager les voies aériennes lors d’une fausse déglutition</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="9">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 09 aide lors du placement d’un tube endotrachéal (tet)</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="10">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 10 aide au placement d’un dispositif supra glottique chez un adulte</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="11">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 11 surveiller un patient avec une voie respiratoire artificielle</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="proc[]" value="12">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">P 12 mesurer la pression artérielle à l’aide d’un tensiomètre automatique </label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="proc[]" value="13">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">P 13 mesurer la pression artérielle à l’aide d’un tensiomètre manuel </label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" name="proc[]" value="14">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">P 14 mesurer la glycémie capillaire</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="15">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 15 mesurer le rythme cardiaque au niveau de l’artère radiale (poignet)</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="16">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 16 mesurer le rythme cardiaque au niveau de l’artère carotide</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="17">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 17 mesurer la température corporelle à l’aide d’un thermomètre auriculaire digital (tympan)</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="proc[]" value="18">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">P 18 mesurer la température corporelle au niveau des aiselles avec un thermomètre digital </label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="proc[]" value="19">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">P 19 mesurer la température corporelle sous la langue à l’aide un thermomètre digital</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" name="proc[]" value="20">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">P 20 mesurer la température corporelle au niveau rectal d’un enfant à l’aide d’un thermomètre digital</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="21">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 21 utiliser un moniteur cardiaque</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="22">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 22 aide à l’utilisation d’un défibrillateur manuel</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="23">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 23 administrer un médicament par voie orale</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="24">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 24 administrer un aérosol </label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="25">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 25 administrer un aérosol-doseur/ inhalateur</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="26">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 26 préparer une injection sous-cutanée</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="27">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 27 préparer une injection intramusculaire</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="28">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 28 préparer une injection intraveineuse</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="29">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 29 préparer une perfusion </label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="36">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 36 tourner un patient - technique « tourner en bloc » (2 secouristes)</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="37">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 37 poser un collier cervical ‘rigide’ (2 secouristes)</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="38">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 38 déplacer un patient avec un scoop (2 secouristes)</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="39">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 39 immobilisation d’un patient a l’aide d’un matelas a depression (2 secouristes)</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="40">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 40 immobilisation d’un patient avec une planche (2 secouristes)</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="41">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 41 poser un dispositif d’extraction (2 secouristes)</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="42">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 42 enlever un casque intégral (2 secouristes)</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="43">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 43 poser un bandage circulaire</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="44">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 44 poser un bandage en spica</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="45">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 45 poser un bandage au niveau d’une articulation</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="46">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 46 poser une attelle à dépression (2 secouristes)</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="47">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 47 aide à la ponction d’une chambre implantable</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="48">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 48 aide à l’exsufflation d’un pneumothorax sous tension (suffocant)on d’un pneumothorax sous tension (suffocant)</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="49">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 49 aide au placement d’un dispositif respiratoire à pression positive continue (cpap)</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" name="proc[]" value="50">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">P 50 contention visant à prevenir des blessures corporelles</label>
                                    </div>
                                </div>
                            </div>    
                            <hr class="mb-4">
                            <div class="mb-3">
                                <label for="menuderoulant" class="form-label">Ordre Permanents</label>
                                <select class="form-select" id="menuderoulant" name="ordre">
                                    <option value="0" selected>Pas d'op</option>
                                    <option value="1">OP1</option>
                                    <option value="2">OP2</option>
                                    <option value="3">OP3</option>
                                    <option value="4">OP4</option>
                                    <option value="5">OP2</option>
                                    <option value="6">OP3</option>
                                    <option value="7">OP1</option>
                                    <option value="8">OP2</option>
                                    <option value="9">OP3</option>
                                    <option value="10">OP1</option>
                                    <option value="11">OP2</option>
                                    <option value="12">OP3</option>
                                    <option value="13">OP1</option>
                                    <option value="14">OP2</option>
                                    <option value="15">OP3</option>
                                    <option value="16">OP1</option>
                                    <option value="17">OP2</option>
                                    <option value="18">OP3</option>
                                    <option value="19">OP1</option>
                                    <option value="20">OP2</option>
                                    <option value="21">OP3</option>
                                    <option value="22">OP2</option>
                                    <option value="23">OP3</option>
                                    <option value="24">OP1</option>
                                    <option value="25">OP2</option>
                                    <option value="26">OP3</option>
                                    <option value="27">OP1</option>
                                    <option value="28">OP2</option>
                                    <option value="29">OP3</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-5">
                        <div class="card-header">12# Réévaluation du bilan / Evaluation du degré d’urgence</div>
                        <div class="card-body">
                            <textarea name="editor1" class="form-control" placeholder="Comment a évalué le bilan et a quel point est-il urgent ?" id="autosize" style="min-height: 100px"><?php if ($exist_mission && !empty($find_mission['reevalution'])) {
                                                                                                                                                                                                echo stripslashes(str_replace("\\r\\n", PHP_EOL, $find_mission['reevalution']));
                                                                                                                                                                                            } ?></textarea>
                        </div>
                    </div>
                    <div class="card mb-5">
                        <div class="card-header">13# Décision d’appel à un autre moyen de secours</div>
                        <div class="card-body">
                            <textarea name="editor2" class="form-control" placeholder="Moyen supplémentaire engagé ? Aurai été nécessaire ? Analyse" id="autosize" style="min-height: 100px"><?php if ($exist_mission && !empty($find_mission['autre_moyen'])) {
                                                                                                                                                                                                    echo stripslashes(str_replace("\\r\\n", PHP_EOL, $find_mission['autre_moyen']));
                                                                                                                                                                                                } ?></textarea>
                        </div>
                    </div>
                    <div class="card mb-5">
                        <div class="card-header">14# Descriptif des gestes techniques effectués par le stagiaire</div>
                        <div class="card-body">
                            <textarea name="editor3" class="form-control" placeholder="Qu'avez vous fait ? Comment analysé vous ? Chose à améliorer ?" id="autosize" style="min-height: 100px"><?php if ($exist_mission && !empty($find_mission['actes_stagiaire'])) {
                                                                                                                                                                                                    echo stripslashes(str_replace("\\r\\n", PHP_EOL, $find_mission['actes_stagiaire']));
                                                                                                                                                                                                } ?></textarea>
                        </div>
                    </div>
                    <div class="card mb-5">
                        <div class="card-header">15# Surveillance du transport</div>
                        <div class="card-body">
                            <div class="form-floating mb-3">
                                <textarea name="editor4" class="form-control" placeholder="Point d'attention pendant le transport ?" id="autosize" style="min-height: 100px"><?php if ($exist_mission && !empty($find_mission['surveillance'])) {
                                                                                                                                                                                    echo stripslashes(str_replace("\\r\\n", PHP_EOL, $find_mission['surveillance']));
                                                                                                                                                                                } ?></textarea>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <div class="svg-border-rounded text-dark">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor">
            <path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path>
        </svg>
    </div>
</section>
</main>
<?php include_once('./libs/footer.php'); ?>