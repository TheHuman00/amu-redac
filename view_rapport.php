<?php 
$pagetitre = "Horaires - Infinotes";
$footerdark = true;
require_once('includes/load.php');
if(!$session->isUserLoggedIn()) { redirect('login', false);}
$user = current_user();
$id = htmlspecialchars($_GET['id']);
if (!$id) {
	$session->msg("d", "Identifiant manquant.");
	redirect("rapport");
}else{
    $rapport = find_by_id('rapports', $id);
    if($rapport['user'] !== $user['email']){
        redirect("rapport");
    }
    $count_mission = count_mission_fini($id);
    $title1 = trouver_titre_mission($id,"1");
    $title2 = trouver_titre_mission($id,"2");
    $title3 = trouver_titre_mission($id,"3");
    $title4 = trouver_titre_mission($id,"4");
    $title5 = trouver_titre_mission($id,"5");

    $count_mission_smur = count_mission_fini_smur($id);
    $title1_smur = trouver_titre_mission_smur($id,"1");
    $title2_smur = trouver_titre_mission_smur($id,"2");
    $title3_smur = trouver_titre_mission_smur($id,"3");
    $title4_smur = trouver_titre_mission_smur($id,"4");
    $title5_smur = trouver_titre_mission_smur($id,"5");
}
$database = new MySqli_DB();
include_once('./libs/header.php'); ?>
                    <section class="bg-white py-5">
                    <?php echo display_msg($msg); ?>
                        <div class="container px-5">
                            <div class="row gx-5 justify-content-center">
                                <div class="col-lg-10">
                                <h1 class="text-center">Rapport - <?php echo $rapport['title']?></h1>
                                <p class="text-center text-muted mb-4">Télécharger le rapport en bas de la page</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h2 class="mb-0">Mission - AMBULANCE</h2>
                                        <div class="badge bg-<?php if($count_mission == "5"){echo "success";}else{echo "primary";}?>-soft text-<?php if($count_mission == "5"){echo "success";}else{echo "primary";}?> badge-marketing"><?php echo $count_mission?>/5 marqué terminé</div>
                                    </div>
                                    <hr class="mb-0" />
                                    <ul class="list-group list-group-flush list-group-careers">
                                        <li class="list-group-item">
                                            <a <?php if(!empty($title1)){echo "class=\"text-secondary\"";}?> href="view_mission?id=<?php echo $id;?>&mission=1"><?php if(!empty($title1)){echo $title1;}else{echo "Aucune mission enregistrée";}?></a>
                                            <div class="small">Mission 1</div>
                                        </li>
                                        <li class="list-group-item">
                                            <a <?php if(!empty($title2)){echo "class=\"text-secondary\"";}?> href="view_mission?id=<?php echo $id;?>&mission=2"><?php if(!empty($title2)){echo $title2;}else{echo "Aucune mission enregistrée";}?></a>
                                            <div class="small">Mission 2</div>
                                        </li>
                                        <li class="list-group-item">
                                            <a <?php if(!empty($title3)){echo "class=\"text-secondary\"";}?> href="view_mission?id=<?php echo $id;?>&mission=3"><?php if(!empty($title3)){echo $title3;}else{echo "Aucune mission enregistrée";}?></a>
                                            <div class="small">Mission 3</div>
                                        </li>
                                        <li class="list-group-item">
                                            <a <?php if(!empty($title4)){echo "class=\"text-secondary\"";}?> href="view_mission?id=<?php echo $id;?>&mission=4"><?php if(!empty($title4)){echo $title4;}else{echo "Aucune mission enregistrée";}?></a>
                                            <div class="small">Mission 4</div>
                                        </li>
                                        <li class="list-group-item">
                                            <a <?php if(!empty($title5)){echo "class=\"text-secondary\"";}?> href="view_mission?id=<?php echo $id;?>&mission=5"><?php if(!empty($title5)){echo $title5;}else{echo "Aucune mission enregistrée";}?></a>
                                            <div class="small">Mission 5</div>
                                        </li>
                                    </ul>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h2 class="mb-0">Mission - SMUR ou PIT</h2>
                                        <div class="badge bg-<?php if($count_mission_smur == "5"){echo "success";}else{echo "primary";}?>-soft text-<?php if($count_mission_smur == "5"){echo "success";}else{echo "primary";}?> badge-marketing"><?php echo $count_mission_smur?>/5 marqué terminé</div>
                                    </div>
                                    <hr class="mb-0" />
                                    <ul class="list-group list-group-flush list-group-careers">
                                    <li class="list-group-item">
                                            <a <?php if(!empty($title1_smur)){echo "class=\"text-secondary\"";}?> href="view_mission-smur?id=<?php echo $id;?>&mission=1"><?php if(!empty($title1_smur)){echo $title1_smur;}else{echo "Aucune mission enregistrée";}?></a>
                                            <div class="small">Mission 1</div>
                                        </li>
                                        <li class="list-group-item">
                                            <a <?php if(!empty($title2_smur)){echo "class=\"text-secondary\"";}?> href="view_mission-smur?id=<?php echo $id;?>&mission=2"><?php if(!empty($title2_smur)){echo $title2_smur;}else{echo "Aucune mission enregistrée";}?></a>
                                            <div class="small">Mission 2</div>
                                        </li>
                                        <li class="list-group-item">
                                            <a <?php if(!empty($title3_smur)){echo "class=\"text-secondary\"";}?> href="view_mission-smur?id=<?php echo $id;?>&mission=3"><?php if(!empty($title3_smur)){echo $title3_smur;}else{echo "Aucune mission enregistrée";}?></a>
                                            <div class="small">Mission 3</div>
                                        </li>
                                        <li class="list-group-item">
                                            <a <?php if(!empty($title4_smur)){echo "class=\"text-secondary\"";}?> href="view_mission-smur?id=<?php echo $id;?>&mission=4"><?php if(!empty($title4_smur)){echo $title4_smur;}else{echo "Aucune mission enregistrée";}?></a>
                                            <div class="small">Mission 4</div>
                                        </li>
                                        <li class="list-group-item">
                                            <a <?php if(!empty($title5_smur)){echo "class=\"text-secondary\"";}?> href="view_mission-smur?id=<?php echo $id;?>&mission=5"><?php if(!empty($title5_smur)){echo $title5_smur;}else{echo "Aucune mission enregistrée";}?></a>
                                            <div class="small">Mission 5</div>
                                        </li>
                                    </ul>
                                    <hr class="my-5" />
                                    <div class="card bg-light shadow-none">
                                        <div class="card-body text-center p-5">
                                            <h2>Visualiser le rapport</h2>
                                            <p class="lead mb-4">Ici vous pouvez télécharger le rapport rempli avec les informations ci-dessus, sous formas docx (seul format disponible pour l'instant)</p>
                                            <a class="btn btn-primary fw-500" href="download?id=<?php echo $id?>">Télécharger le rapport (.DOCX)</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="svg-border-rounded text-dark">
                            <!-- Rounded SVG Border-->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path></svg>
                        </div>
                    </section>
                </main>
<?php include_once('./libs/footer.php');?>
