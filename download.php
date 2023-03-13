<?php 
$pagetitre = "Rapport - AMU-Rédac";
$footerdark = true;
require_once('includes/load.php');
if(!$session->isUserLoggedIn()) { redirect('login', false);}
$user = current_user();
$database = new MySqli_DB();
$id = htmlspecialchars($_GET['id']);
if (!$id) {
	$session->msg("d", "Identifiant manquant.");
	redirect("rapport");
}else{
    $rapport = trouver_rapport($id);
    if($rapport['user'] !== $user['email']){
        redirect("rapport");
    }
}

if (isset($_POST['update_rapport'])) {

    if (empty($errors)) {
      $nom   = remove_junk($db->escape($_POST['nom']));
      $service   = remove_junk($db->escape($_POST['service']));
      $annee   = remove_junk($db->escape($_POST['annee']));
      $query = $database->db_prepare("UPDATE rapports SET nom = ?, service = ?, annee = ? WHERE id = ?");
      $query->bind_param("ssss", $nom, $service, $annee, $id);
      if ($query->execute()) {
        redirect("download_rapport?id=$id", false);
      } else {
        $session->msg('d', "Création du rapport échoué");
        redirect('rapport', false);
      }
    } else {
      $session->msg("d", $errors);
      redirect('rapport', false);
    }
  }

include_once('./libs/header.php'); ?>
                    <section class="bg-light py-10">
                    <?php echo display_msg($msg); ?>
                        <div class="container px-5">
                            <div class="row gx-5 justify-content-center">
                                <div class="col-lg-8 text-center">
                                    <h2>Télécharger son rapport ?</h2>
                                    <p class="lead mb-5">Remplisser les informations nécessaire à sa création.</p>
                                </div>
                            </div>
                            <div class="row gx-5 justify-content-center">
                                <div class="col-lg-8">
                                    <form method="post" action="download?id=<?php echo $id;?>" class="clearfix">
                                        <div class="row gx-5 mb-4">
                                            <div class="col-md-6">
                                                <label class="text-dark mb-2" for="inputName">Nom et prénom</label>
                                                <input class="form-control py-4" id="inputName" name="nom" type="text" placeholder="Nom et prénom" <?php if(!empty($rapport['nom'])){echo "value=\"".$rapport["nom"]."\"";}?>/>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="text-dark mb-2" for="inputDate">Service agréé</label>
                                                <input class="form-control py-4" id="inputDate" name="service" type="text" placeholder="Nom du service" <?php if(!empty($rapport['service'])){echo "value=\"".$rapport["service"]."\"";}?>/>
                                            </div>
                                        </div>
                                        <div class="row gx-5 mb-4">
                                            <div class="col-md-6">
                                                <label class="text-dark mb-2" for="inputName">Promotion</label>
                                                <input class="form-control py-4" id="inputName" name="annee" type="text" placeholder="Année de promotion" <?php if(!empty($rapport['annee'])){echo "value=\"".$rapport["annee"]."\"";}?>/>
                                            </div>
                                            <div class="col-md-6">
                                            <a class="card card-link border-bottom-0 border-start-0 border-end-0 border-top-lg h-100 lift">
                                                <div class="card-body p-5">
                                                    <h6>.DOCX</h6>
                                                    <p class="card-text">N'oublier pas de rajouter vos annexes ! (PROCHAINEMENT)</p>
                                                </div>
                                            </a>
                                            </div>
                                        </div>
                                        
                                        <div class="text-center"><button class="btn btn-primary mt-4" name="update_rapport" type="submit">Télécharger le rapport</button></div>
                                    </form>
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
