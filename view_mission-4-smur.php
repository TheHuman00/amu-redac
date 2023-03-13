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
        $query = $database->db_prepare("INSERT INTO missions_smur (id_rapports,id_mission,actes,reevalution,autre_moyen,actes_stagiaire,surveillance) VALUES (?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE actes = ?, reevalution = ?, autre_moyen = ?, actes_stagiaire = ?, surveillance = ?");
        $query->bind_param("ssssssssssss", $id, $mission, $editor, $editor1, $editor2, $editor3, $editor4, $editor, $editor1, $editor2, $editor3, $editor4);
        if ($query->execute()) {
            $session->msg('s', `Mission sauvegardée`);
            redirect("view_mission-5-smur?id=$id&mission=$mission&sauv=ok", false);
        } else {
            $session->msg('d', "Ajout du rapport échoué");
            redirect(`rapport`);
        }
    } else {
        $session->msg("d", $errors);
        redirect(`view_mission-4-smur?id=$id&mission=$mission`);
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
                <form method="post" action="view_mission-4-smur?id=<?php echo $id; ?>&mission=<?php echo $mission; ?>">
                    <div class="d-flex align-items-center justify-content-between flex-column flex-md-row">
                        <h2 class="mb-0">Analyse pratique de la mission</h2>
                        <button class="btn btn-secondary btn-m me-2" name="sauv_1" type="submit">Sauvegarder et suivant</button>
                    </div>
                    <hr class="mb-4" />
                    <div class="card mb-5">
                        <div class="card-header">11# Actes ambulanciers réalisés sur place (en référence aux OP et Procédures)</div>
                        <div class="card-body">
                                <textarea name="editor" class="form-control" id="autosize" placeholder="Quel actes ont été réalisé par les !!ambulanciers!! ? A quel procédure fédéral fait référence ?" style="min-height: 100px"><?php if ($exist_mission && !empty($find_mission['actes'])) {
                                                                        echo str_replace("\\r\\n" ,PHP_EOL , $find_mission['actes']);
                                                                    }?></textarea>
                        </div>
                    </div>

                    <div class="card mb-5">
                        <div class="card-header">12# Réévaluation du bilan / Evaluation du degré d’urgence</div>
                        <div class="card-body">
                                <textarea name="editor1" class="form-control" id="autosize" placeholder="Comment a évalué le bilan et a quel point est-il urgent ?" style="min-height: 100px"><?php if ($exist_mission && !empty($find_mission['reevalution'])) {
                                                                            echo str_replace("\\r\\n" ,PHP_EOL , $find_mission['reevalution']);
                                                                        }?></textarea>
                        </div>
                    </div>
                    <div class="card mb-5">
                        <div class="card-header">13# Décision d’appel à un autre moyen de secours</div>
                        <div class="card-body">
                                <textarea name="editor2" class="form-control" placeholder="Moyen supplémentaire engagé ? Aurai été nécessaire ? Analyse" id="autosize" style="min-height: 100px"><?php if ($exist_mission && !empty($find_mission['autre_moyen'])) {
                                                                            echo str_replace("\\r\\n" ,PHP_EOL , $find_mission['autre_moyen']);
                                                                        } ?></textarea>
                        </div>
                    </div>
                    <div class="card mb-5">
                        <div class="card-header">14# Descriptif des gestes techniques effectués par le stagiaire</div>
                        <div class="card-body">
                                <textarea name="editor3" class="form-control" placeholder="Qu'avez vous fait ? Comment analysé vous ? Chose à améliorer ?" id="autosize" style="min-height: 100px"><?php if ($exist_mission && !empty($find_mission['actes_stagiaire'])) {
                                                                            echo str_replace("\\r\\n" ,PHP_EOL , $find_mission['actes_stagiaire']);
                                                                        } ?></textarea>
                        </div>
                    </div>
                    <div class="card mb-5">
                        <div class="card-header">15# Surveillance du transport</div>
                        <div class="card-body">
                            <div class="form-floating mb-3">
                                <textarea name="editor4" class="form-control" placeholder="Point d'attention pendant le transport ?" id="autosize" style="min-height: 100px"><?php if ($exist_mission && !empty($find_mission['surveillance'])) {
                                                                            echo str_replace("\\r\\n" ,PHP_EOL , $find_mission['surveillance']);
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