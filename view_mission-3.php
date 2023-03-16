<?php
$pagetitre = "ABCDE";
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
        $editor   = remove_junk($db->escape($_POST['editor']));
        $editor1   = remove_junk($db->escape($_POST['editor1']));
        $editor2   = remove_junk($db->escape($_POST['editor2']));
        $editor3   = remove_junk($db->escape($_POST['editor3']));
        $editor4   = remove_junk($db->escape($_POST['editor4']));
        $query = $database->db_prepare("INSERT INTO missions_ambu (id_rapports,id_mission,a,b,c,d,e) VALUES (?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE a = ?, b = ?, c = ?, d = ?, e = ?");
        $query->bind_param("ssssssssssss", $id, $mission, $editor, $editor1, $editor2, $editor3, $editor4, $editor, $editor1, $editor2, $editor3, $editor4);
        if ($query->execute()) {
            $session->msg('s', `Mission sauvegardée`);
            redirect("view_mission-4?id=$id&mission=$mission&sauv=ok", false);
        } else {
            $session->msg('d', "Ajout du rapport échoué");
            redirect(`rapport`);
        }
    } else {
        $session->msg("d", $errors);
        redirect(`view_mission-3?id=$id&mission=$mission`);
    }
}

$a_content = "# Observations
# Actions menés
# Analyse du système / Points d'attentions";
$b_content = "# Paramètres
Fréquence : 
Volume : 
Travail respiratoire majoré :
Oxygène :
# Observations
# Actions menés
# Analyse du système / Points d'attentions";
$c_content = "# Paramètres
Perfusion périphérique :
Pouls :
Pression artérielle :
Précharge :

# Observations
# Actions menés
# Analyse du système / Points d'attentions
";
$d_content = "# Paramètres
GCS : 
    Ouverture des yeux :
    Réponse verbale :
    Réponse motrice :
    Total Score = 15/15
Pupilles :
Glycémie :
Motricité :

# Observations
# Actions
# Analyse du système / Points d'attentions";
$e_content = "# Paramètres
SAMPLE :
    Allergie :
    Médicaments : 
    Passé médical :
    Longueur du jeun :
    Evénement :
    Body scan :

# Observations
# Actions
# Analyse du système / Points d'attentions";

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
                <form method="post" action="view_mission-3?id=<?php echo $id; ?>&mission=<?php echo $mission; ?>">
                    <div class="d-flex align-items-center justify-content-between flex-column flex-md-row">
                        <h2 class="mb-0">ABCDE</h2>
                        <button class="btn btn-secondary btn-m me-2" name="sauv_1" type="submit">Sauvegarder et suivant</button>
                    </div>
                    <hr class="mb-4" />
                    <div class="card mb-5">
                        <div class="card-header">6# A</div>
                        <div class="card-body">
                            <textarea name="editor" class="form-control" id="autosize" style="min-height: 100px"><?php if ($exist_mission && !empty($find_mission['a'])) {
                                                                                                                        echo str_replace("\\r\\n", PHP_EOL, $find_mission['a']);
                                                                                                                    } else {
                                                                                                                        echo $a_content;
                                                                                                                    } ?></textarea>
                        </div>
                    </div>

                    <div class="card mb-5">
                        <div class="card-header">7# B</div>
                        <div class="card-body">
                            <textarea name="editor1" class="form-control" id="autosize" style="min-height: 100px"><?php if ($exist_mission && !empty($find_mission['b'])) {
                                                                                                                        echo str_replace("\\r\\n", PHP_EOL, $find_mission['b']);
                                                                                                                    } else {
                                                                                                                        echo $b_content;
                                                                                                                    } ?></textarea>
                        </div>
                    </div>
                    <div class="card mb-5">
                        <div class="card-header">8# C</div>
                        <div class="card-body">
                            <textarea name="editor2" class="form-control" id="autosize" style="min-height: 100px"><?php if ($exist_mission && !empty($find_mission['c'])) {
                                                                                                                        echo str_replace("\\r\\n", PHP_EOL, $find_mission['c']);
                                                                                                                    } else {
                                                                                                                        echo $c_content;
                                                                                                                    } ?></textarea>
                        </div>
                    </div>
                    <div class="card mb-5">
                        <div class="card-header">9# D</div>
                        <div class="card-body">
                            <textarea name="editor3" class="form-control" id="autosize" style="min-height: 100px"><?php if ($exist_mission && !empty($find_mission['d'])) {
                                                                                                                        echo str_replace("\\r\\n", PHP_EOL, $find_mission['d']);
                                                                                                                    } else {
                                                                                                                        echo $d_content;
                                                                                                                    } ?></textarea>
                        </div>
                    </div>
                    <div class="card mb-5">
                        <div class="card-header">10# E</div>
                        <div class="card-body">
                            <textarea name="editor4" class="form-control" id="autosize" style="min-height: 100px"><?php if ($exist_mission && !empty($find_mission['e'])) {
                                                                                                                        echo str_replace("\\r\\n", PHP_EOL, $find_mission['e']);
                                                                                                                    } else {
                                                                                                                        echo $e_content;
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