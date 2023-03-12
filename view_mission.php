<?php
$pagetitre = "Introduction de mission";
$footerdark = true;
require_once('includes/load.php');
if (!$session->isUserLoggedIn()) {
    redirect('login', false);
}
$user = current_user();
$id = $_GET['id'];
$mission = $_GET['mission'];
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
        if($find_mission){
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
        $title   = remove_junk($db->escape(base64_encode($_POST['titre'])));
        $num_mission   = remove_junk($db->escape($_POST['num_mission']));
        $date_heure   = remove_junk($db->escape(base64_encode($_POST['date_heure'])));
        $motif   = remove_junk($db->escape(base64_encode($_POST['motif'])));
        $editor   = remove_junk($db->escape($_POST['editor']));
        $query = $database->db_prepare("INSERT INTO missions_ambu (id_rapports,id_mission,title,num_mission,date_heure,motif,bilan_cir) VALUES (?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE title = ?, num_mission = ?, date_heure = ?, motif = ?, bilan_cir = ?");
        $query->bind_param("ssssssssssss", $id, $mission, $title, $num_mission, $date_heure, $motif, $editor, $title, $num_mission, $date_heure, $motif, $editor);
        if ($query->execute()) {
            $session->msg('s', `Mission sauvegardée`);
            redirect("view_mission-2?id=$id&mission=$mission&sauv=ok", false);
        } else {
            $session->msg('d', "Ajout du rapport échoué");
            redirect(`rapport`);
        }
    } else {
        $session->msg("d", $errors);
        redirect(`view_mission?id=$id&mission=$mission`);
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
            <form method="post" action="view_mission?id=<?php echo $id; ?>&mission=<?php echo $mission; ?>">
                <div class="d-flex align-items-center justify-content-between flex-column flex-md-row">
                    <h2 class="mb-0">Introduction de mission</h2>
                    <button class="btn btn-secondary btn-m me-2" name="sauv_1" type="submit">Sauvegarder et suivant</button>
                </div>
                <hr class="mb-4" />
                <div class="card mb-5">
                    <div class="card-header">1# Mission</div>
                    <div class="card-body">
                            <div class="form-floating mb-3">
                                <input class="form-control" <?php if($exist_mission){echo "value=\"".base64_decode($find_mission['title'])."\"";}?> name="titre" type="text" placeholder="Titre de la mission" />
                                <label for="titre">Titre de la mission</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" <?php if($exist_mission){echo "value=\"".$find_mission['num_mission']."\"";}?> name="num_mission" type="text" placeholder="Numéro de mission" />
                                <label for="num_mission">Numéro de mission</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" <?php if($exist_mission){echo "value=\"".base64_decode($find_mission['date_heure'])."\"";}?> name="date_heure" type="text" placeholder="Date et heure de la mission" />
                                <label for="date_heure">Date et heure de la mission</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="autosize" name="motif" style="height: 75px"><?php if($exist_mission){echo base64_decode($find_mission['motif']);}?></textarea>
                                <label for="motif">Motif d'appel</label>
                            </div>
                    </div>
                </div>

                <div class="card mb-5">
                    <div class="card-header">2# Bilan de la situation à l'arrivée</div>
                    <div class="card-body">
                        <textarea class="form-control" id="autosize" name="editor" style="min-height: 100px"><?php if($exist_mission){echo str_replace("\\r\\n" ,PHP_EOL ,$find_mission['bilan_cir']);}?></textarea>
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