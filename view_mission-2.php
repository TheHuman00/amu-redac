<?php
$pagetitre = "SSS - Quick Look";
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
        $sexe   = remove_junk($db->escape(base64_encode($_POST['sexe'])));
        $age   = remove_junk($db->escape($_POST['age']));
        $antcd   = remove_junk($db->escape(base64_encode($_POST['antcd'])));
        $editor   = remove_junk($db->escape($_POST['editor']));
        $EPADONO   = remove_junk($db->escape(($_POST['EPADONO'])));
        $position   = remove_junk($db->escape($_POST['position']));
        $editor1   = remove_junk($db->escape($_POST['editor1']));
        $editor2   = remove_junk($db->escape($_POST['editor2']));
        $editor3   = remove_junk($db->escape($_POST['editor3']));
        $query = $database->db_prepare("INSERT INTO missions_ambu (id_rapports,id_mission,sexe,age,antcd,sss,EPADONO,position,airways_ql,breathing_ql,circulation_ql) VALUES (?,?,?,?,?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE sexe = ?, age = ?, antcd = ?, sss = ?, EPADONO = ?, position = ?, airways_ql = ?, breathing_ql = ?, circulation_ql = ?");
        $query->bind_param("ssssssssssssssssssss", $id, $mission, $sexe, $age, $antcd, $editor, $EPADONO, $position, $editor1, $editor2, $editor3, $sexe, $age, $antcd, $editor, $EPADONO, $position, $editor1, $editor2, $editor3);
        if ($query->execute()) {
            $session->msg('s', `Mission sauvegardée`);
            redirect("view_mission-3?id=$id&mission=$mission&sauv=ok", false);
        } else {
            $session->msg('d', "Ajout du rapport échoué");
            redirect(`rapport`);
        }
    } else {
        $session->msg("d", $errors);
        redirect(`view_mission-2?id=$id&mission=$mission`);
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
                <form method="post" action="view_mission-2?id=<?php echo $id; ?>&mission=<?php echo $mission; ?>">
                    <div class="d-flex align-items-center justify-content-between flex-column flex-md-row">
                        <h2 class="mb-0">SSS - Quick Look</h2>
                        <button class="btn btn-secondary btn-m me-2" name="sauv_1" type="submit">Sauvegarder et suivant</button>
                    </div>
                    <hr class="mb-4" />
                    <div class="card mb-5">
                        <div class="card-header">3# Intro Victime</div>
                        <div class="card-body">
                            <div class="form-floating mb-3">
                                <input class="form-control" <?php if ($exist_mission && !empty($find_mission['sexe'])) {
                                                                echo "value=\"" . base64_decode($find_mission['sexe']) . "\"";
                                                            } ?> name="sexe" type="text" placeholder="Sexe de la victime" />
                                <label for="titre">Sexe</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" <?php if ($exist_mission && !empty($find_mission['age'])) {
                                                                echo "value=\"" . $find_mission['age'] . "\"";
                                                            } ?> name="age" type="text" placeholder="Age" />
                                <label for="num_mission">Age</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="autosize" placeholder="Effectuer une liste simple des antécédents connu surplace de la victime" name="antcd" style="min-height: 100px"><?php if ($exist_mission && !empty($find_mission['antcd'])) {
                                                                                                                                                                                                                echo base64_decode($find_mission['antcd']);
                                                                                                                                                                                                            } ?></textarea>
                                <label for="motif">Antécédents</label>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-5">
                        <div class="card-header">4# SSS</div>
                        <div class="card-body">
                            <textarea class="form-control" id="autosize" name="editor" placeholder="Comment était la sécurité sur place ? Quel sont les dangers potentiel ?" style="min-height: 100px"><?php if ($exist_mission && !empty($find_mission['SSS'])) {
                                                                                                                                                                                                            echo stripslashes(str_replace("\\r\\n", PHP_EOL, $find_mission['SSS']));
                                                                                                                                                                                                        } ?></textarea>
                        </div>
                    </div>
                    <div class="card mb-5">
                        <div class="card-header">5# QuickLook</div>
                        <div class="card-body">
                            <h4>EPaDoNo</h4>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="EPADONO" id="inlineRadio1" value="eveil" <?php if ($exist_mission && !empty($find_mission['EPADONO'])) {
                                                                                                                                if ($find_mission['EPADONO'] == "eveil") {
                                                                                                                                    echo "checked";
                                                                                                                                }
                                                                                                                            } ?>>
                                <label class="form-check-label" for="inlineRadio1">Eveil</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="EPADONO" id="inlineRadio2" value="parole" <?php if ($exist_mission && !empty($find_mission['EPADONO'])) {
                                                                                                                                    if ($find_mission['EPADONO'] == "parole") {
                                                                                                                                        echo "checked";
                                                                                                                                    }
                                                                                                                                } ?>>
                                <label class="form-check-label" for="inlineRadio2">Parole</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="EPADONO" id="inlineRadio3" value="douleur" <?php if ($exist_mission && !empty($find_mission['EPADONO'])) {
                                                                                                                                    if ($find_mission['EPADONO'] == "douleur") {
                                                                                                                                        echo "checked";
                                                                                                                                    }
                                                                                                                                } ?>>
                                <label class="form-check-label" for="inlineRadio3">Douleur</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="EPADONO" id="inlineRadio4" value="no_response" <?php if ($exist_mission && !empty($find_mission['EPADONO'])) {
                                                                                                                                        if ($find_mission['EPADONO'] == "no_response") {
                                                                                                                                            echo "checked";
                                                                                                                                        }
                                                                                                                                    } ?>>
                                <label class="form-check-label" for="inlineRadio4">No response</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" <?php if ($exist_mission && !empty($find_mission['position'])) {
                                                                echo "value=\"" . $find_mission['position'] . "\"";
                                                            } ?> name="position" type="text" placeholder="Position de la victime" />
                                <label for="titre">Position de la victime</label>
                            </div>
                            <h4>Airways (du quicklook)</h4>
                            <textarea name="editor1" class="form-control" placeholder="[Brievement] Comment était les voies respiratoires ?" id="autosize" style="min-height: 100px"><?php if ($exist_mission && !empty($find_mission['airways_ql'])) {
                                                                                                                                                                                            echo stripslashes(str_replace("\\r\\n", PHP_EOL, $find_mission['airways_ql']));
                                                                                                                                                                                        } ?></textarea>
                            <h4>Breathing (du quicklook)</h4>
                            <textarea name="editor2" class="form-control" placeholder="[Brievement] Comment était la respiration subjectivement ? (difficulté respi apparante ?)" id="autosize" style="min-height: 100px"><?php if ($exist_mission && !empty($find_mission['breathing_ql'])) {
                                                                                                                                                                                                                                echo stripslashes(str_replace("\\r\\n", PHP_EOL, $find_mission['breathing_ql']));
                                                                                                                                                                                                                            } ?></textarea>
                            <h4>Circulation (du quicklook)</h4>
                            <textarea name="editor3" class="form-control" placeholder="[Brievement] Comment était le pouls ? (Frappé, régulier ?)" id="autosize" style="min-height: 100px"><?php if ($exist_mission && !empty($find_mission['circulation_ql'])) {
                                                                                                                                                                                                echo stripslashes(str_replace("\\r\\n", PHP_EOL, $find_mission['circulation_ql']));
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