<?php
$page_title = 'Mots de passe';
require_once('includes/load.php');
if(!$session->isUserLoggedIn()) { redirect('index', false);}
$user = current_user();
$database = new MySqli_DB();

if (isset($_POST['update'])) {

  if (empty($errors)) {

    if (!password_verify($_POST['old-password'], current_user()['password'])) {
      $session->msg('d', "Votre ancien mot de passe ne correspond pas");
      redirect('changer_mdp', false);
    }

    $id = (int)$_POST['id'];
    $new = remove_junk($db->escape(password_hash($_POST['new-password'], PASSWORD_DEFAULT, ["cost" => 12])));
    $sql = $database->db_prepare("UPDATE users SET password ='{$new}' WHERE id=?");
    $sql->bind_param('i', $id);
    $result = $sql->execute();
    $sql_result = $sql->get_result();
    if ($result && $db->affected_rows($sql_result) === 1) :
      $session->logout();
      $session->msg('s', "Connectez-vous avec votre nouveau mot de passe.");
      redirect('index', false);
    else :
      $session->msg('d', ' Désolé, échec de la mise à jour de votre mots de passe!');
      redirect('changer_mdp', false);
    endif;
  } else {
    $session->msg("d", $errors);
    redirect('changer_mdp', false);
  }
}
include_once('./libs/header.php'); ?>
<?php echo display_msg($msg); ?>
<section class="py-5">
  <div class="container px-2">
    <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
      <div class="text-center mb-5">
        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-credit-card"></i></div>
        <h1 class="fw-bolder">Changer son mots de passe</h1>
        <p class="lead fw-normal text-muted mb-0">L'oubile pas hn</p>
      </div>
      <div class="row gx-5 justify-content-center">
        <div class="col-lg-8 col-xl-6">
          <form method="post" action="changer_mdp" class="clearfix">
            <div class="form-floating mb-3">
              <input class="form-control" type="text" name="old-password" placeholder="Ancien mot de passe..." required />
              <label for="ancien">Ancien mot de passe</label>
            </div>
            <div class="form-floating mb-3">
              <input class="form-control" type="text" name="new-password" placeholder="Nouveau mot de passe..." required />
              <label for="ancien">Nouveau mot de passe</label>
            </div>
            <input type="hidden" name="id" value="<?php echo (int)$user['id']; ?>">
            <div class="d-grid"><button class="btn btn-primary btn-lg" name="update" type="submit">Modifier</button></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include_once('./libs/footer.php'); ?>