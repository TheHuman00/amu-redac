<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('rapport', false);}
  $user = current_user(); 
  $database = new MySqli_DB();
  require_once('libs/header.php');

  if (isset($_POST['add_user'])) {

    if (empty($errors)) {
      $email   = remove_junk($db->escape($_POST['email']));
      $password2   = remove_junk($db->escape($_POST['password']));
      $info   = remove_junk($db->escape($_POST['info']));
      $password = password_hash($password2, PASSWORD_DEFAULT, ["cost" => 12]);
      $query = $database->db_prepare("INSERT INTO users (email,password,info,user_level) VALUES (?,?,?,'1')");
      $query->bind_param("sss", $email, $password, $info);
      if ($query->execute()) {
        $session->msg('s', "Inscription réussite, connectez-vous");
        redirect('login', false);
      } else {
        $session->msg('d', "Pas les deux mêmes mots de passe");
        redirect('register', false);
      }
    } else {
      $session->msg("d", $errors);
      redirect('register', false);
    }
  }

  ?>


<section class="vh-100" style="background-color: #f8f9fa;">
<?php echo display_msg($msg); ?>
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            <div class="text-center mb-2"><img src="https://i.imgur.com/SygdId3.png" width="105" height="56"></div>
            <h3 class="mb-2">Créer un compte</h3>
            <p class="mb-5">AMU-Rédac</p>
            <form method="post" action="register" class="clearfix">
            <div class="form-floating mb-3">
              <input class="form-control" name="email" type="email" placeholder="Nom d'utilisateur"/>
              <label for="name">Adresse Email</label>
            </div>
            <div class="form-floating mb-3">
              <input class="form-control" name="password" type="password" placeholder="Mots de passe"/>
              <label for="name">Mots de passe</label>
            </div>
            <div class="form-floating mb-3">
              <input class="form-control" name="password2" type="password" placeholder="Mots de passe"/>
              <label for="name">Confirmer mots de passe</label>
            </div>
            <div class="form-floating mb-3">
              <input class="form-control" name="info" type="text" placeholder="info"/>
              <label for="name">Pour info : Promotion ? (facultatif)</label>
            </div>

            <button class="btn btn-primary btn-block" name="add_user" type="submit">S'enregister</button>
            <hr class="my-4">
            <a href="login">Déjà un compte ? Connectez vous ici.</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include_once('libs/footer.php'); ?> 

