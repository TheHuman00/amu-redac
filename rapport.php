<?php 
$pagetitre = "Rapport - AMU-Rédac";
$footerdark = true;
require_once('includes/load.php');
if (!$session->isUserLoggedIn()) { redirect('login', false);}
$user = current_user();
$database = new MySqli_DB();
$rapports = find_all('rapports');



if (isset($_POST['add_rapport'])) {

    if (empty($errors)) {
      $title   = remove_junk($db->escape($_POST['title']));
      $desc   = "";
      $date   = remove_junk($db->escape($_POST['date']));
      $query = $database->db_prepare("INSERT INTO rapports (user,title,description,date) VALUES (?,?,?,?)");
      $query->bind_param("ssss", $user['email'], $title, $desc, $date);
      if ($query->execute()) {
        $session->msg('s', `Ajout réussit de $title`);
        redirect('rapport', false);
      } else {
        $session->msg('d', "Ajout du rapport échoué");
        redirect('rapport', false);
      }
    } else {
      $session->msg("d", $errors);
      redirect('rapport', false);
    }
  }

include_once('./libs/header.php'); ?>
                 <header class="page-header-ui page-header-ui-dark bg-gradient-primary-to-secondary">
                 <?php echo display_msg($msg); ?>
                        <div class="page-header-ui-content pt-3">
                            <div class="container px-1 text-center">
                                <div class="row gx-5 justify-content-center">
                                    <div class="col-lg-8">
                                        <h1 class="page-header-ui-title mb-3">Mes rapports</h1>
                                        <p class="page-header-ui-text">Ici la liste de tous les rapports entammé.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="svg-border-rounded text-light">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path></svg>
                        </div>
                    </header>
                    <section class="bg-light py-10">
                        <div class="container px-5">
                            <div class="row gx-5 features text-center mb-10">
                            <?php foreach($rapports as $rapport):
                                        if($rapport['user'] == $user['email']):?>
                                <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                                    <a class="card card-link border-bottom-0 border-start-0 border-end-0 border-top-lg border-purple h-100 lift" href="view_rapport?id=<?php echo $rapport["id"]?>">
                                        <div class="card-body p-5">
                                            <div class="icon-stack icon-stack-lg bg-purple-soft text-purple mb-4"><i data-feather="folder"></i></div>
                                            <h6><?php echo $rapport['title']?></h6>
                                            <p class="card-text"><?php echo $rapport['description']?></p>
                                        </div>
                                        <div class="card-footer border-0 bg-transparent pt-0 pb-5"><div class="badge rounded-pill bg-light text-dark fw-normal px-3 py-2"><?php echo $rapport['date']?></div></div>
                                    </a>
                                </div>
                                <?php endif; endforeach;?>
                            </div>
                            <div class="row gx-5 justify-content-center">
                                <div class="col-lg-8 text-center">
                                    <h2>Ajouter un rapport ?</h2>
                                    <p class="lead mb-5">Remplisser les informations nécessaire à sa création.</p>
                                </div>
                            </div>
                            <div class="row gx-5 justify-content-center">
                                <div class="col-lg-8">
                                    <form method="post" action="rapport" class="clearfix">
                                        <div class="row gx-5 mb-4">
                                            <div class="col-md-6">
                                                <label class="text-dark mb-2" for="inputName">Nom du rapport</label>
                                                <input class="form-control py-4" id="inputName" name="title" type="text" placeholder="Nom" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="text-dark mb-2" for="inputDate">Date</label>
                                                <input class="form-control py-4" id="inputDate" type="date" value="<?php echo date("Y-m-d");?>" disabled/>
                                                <input class="form-control py-4" id="inputDate" name="date" type="hidden" value="<?php echo date("Y-m-d");?>"/>
                                            </div>
                                        </div>
                                        <div class="text-center"><button class="btn btn-primary mt-4" name="add_rapport" type="submit">Créer le rapport</button></div>
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
