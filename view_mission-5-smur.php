<?php
$pagetitre = "Analyse et recherche";
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
        $find_mission = trouver_mission_smur($id, $mission);
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
        $editor   = remove_junk($db->escape($_POST['editor']));
        $editor1   = remove_junk($db->escape($_POST['editor1']));
        $editor2   = remove_junk($db->escape($_POST['editor2']));
        $editor3   = remove_junk($db->escape($_POST['editor3']));
        $editor4   = remove_junk($db->escape($_POST['editor4']));
        $query = $database->db_prepare("INSERT INTO missions_smur (id_rapports,id_mission,diff,eval,patho,ressenti,fini) VALUES (?,?,?,?,?,?,'true') ON DUPLICATE KEY UPDATE diff = ?, eval = ?, patho = ?, ressenti = ?, fini = 'true'");
        $query->bind_param("ssssssssss", $id, $mission, $editor, $editor1, $editor2, $editor3, $editor, $editor1, $editor2, $editor3);
        if ($query->execute()) {
            $session->msg('s', `Mission sauvegardée`);
            redirect("view_rapport?id=$id", false);
        } else {
            $session->msg('d', "Ajout du rapport échoué");
            redirect(`rapport`);
        }
    } else {
        $session->msg("d", $errors);
        redirect(`view_mission-5-smur?id=$id&mission=$mission`);
    }
}

include_once('./libs/header.php'); ?>
<style>
    .ck-editor__editable[role="textbox"] {
        min-height: 200px;
    }
</style>
<script src="./JS/ckeditor/ckeditor.js"></script>
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
                        <a class="list-group-item list-group-item-action p-3" href="view_mission-smur?id=<?php echo $id ?>&mission=<?php echo $mission ?>">
                            <i class="far fa-newspaper fa-fw me-2 text-gray-400"></i>
                            Introduction de mission
                        </a>
                        <a class="list-group-item list-group-item-action p-3" href="view_mission-2-smur?id=<?php echo $id ?>&mission=<?php echo $mission ?>">
                            <i class="fas fa-tree fa-fw me-2 text-gray-400"></i>
                            SSS - Quick Look
                        </a>
                        <a class="list-group-item list-group-item-action p-3" href="view_mission-3-smur?id=<?php echo $id ?>&mission=<?php echo $mission ?>">
                            <i class="fas fa-cog fa-fw me-2 text-gray-400"></i>
                            ABCDE
                        </a>
                        <a class="list-group-item list-group-item-action p-3" href="view_mission-4-smur?id=<?php echo $id ?>&mission=<?php echo $mission ?>">
                            <i class="fas fa-briefcase fa-fw me-2 text-gray-400"></i>
                            Analyse pratique de la mission
                        </a>
                        <a class="list-group-item list-group-item-action p-3" href="view_mission-5-smur?id=<?php echo $id ?>&mission=<?php echo $mission ?>">
                            <i class="fas fa-chalkboard-teacher fa-fw me-2 text-gray-400"></i>
                            Analyse et recherche
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xl-9">
                <form method="post" action="view_mission-5-smur?id=<?php echo $id; ?>&mission=<?php echo $mission; ?>">
                    <div class="d-flex align-items-center justify-content-between flex-column flex-md-row">
                        <h2 class="mb-0">Analyse et recherche</h2>
                        <button class="btn btn-warning btn-m me-2" name="sauv_1" type="submit">Sauvegardé et marqué comme fini</button>
                    </div>
                    <hr class="mb-4" />
                    <div class="card mb-5">
                        <div class="card-header">16# Difficultés rencontrées (techniques et/ou psychologiques)</div>
                        <div class="card-body">
                            <textarea name="editor" class="form-control" id="autosize" style="min-height: 100px"><?php if ($exist_mission && !empty($find_mission['diff'])) {
                                                                                                                        echo stripslashes(str_replace("\\r\\n", PHP_EOL, $find_mission['diff']));
                                                                                                                    } ?></textarea>
                        </div>
                    </div>

                    <div class="card mb-5">
                        <div class="card-header">17# Evaluation et critique de la mission</div>
                        <div class="card-body">
                            <textarea name="editor1" class="form-control" id="autosize" style="min-height: 100px"><?php if ($exist_mission && !empty($find_mission['eval'])) {
                                                                                                                        echo stripslashes(str_replace("\\r\\n", PHP_EOL, $find_mission['eval']));
                                                                                                                    } ?></textarea>
                        </div>
                    </div>
                    <div class="card mb-5">
                        <div class="card-header">18# Résumé de la pathologie</div>
                        <div class="card-body">
                            <textarea name="editor2" class="form-control" id="autosize" style="min-height: 150px"><?php if ($exist_mission && !empty($find_mission['patho'])) {
                                                                                                                        echo stripslashes(str_replace("\\r\\n", PHP_EOL, $find_mission['patho']));
                                                                                                                    } ?></textarea>
                        </div>
                    </div>
                    <div class="card mb-5">
                        <div class="card-header">19# Ressenti de la mission</div>
                        <div class="card-body">
                            <textarea name="editor3" class="form-control" id="autosize" style="min-height: 100px"><?php if ($exist_mission && !empty($find_mission['ressenti'])) {
                                                                                                                        echo stripslashes(str_replace("\\r\\n", PHP_EOL, $find_mission['ressenti']));
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