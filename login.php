<?php
ob_start();
require_once('includes/load.php');
if ($session->isUserLoggedIn()) {
  redirect('rapport', false);
}
$user = current_user();
require_once('libs/header.php'); ?>


<section class="vh-100" style="background-color: #f8f9fa;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            <div class="text-center mb-2"><img src="./assets/img/form.png" width="105" height="56" alt="Logo de amu-redac avec fond blanc"></div>
            <h3 class="mb-2">Se connecter</h3>
            <p class="mb-5">AMU-Rédac</p>
            <form method="post" action="auth" class="clearfix">
              <div class="form-floating mb-3">
                <input class="form-control" name="email" type="text" placeholder="email" />
                <label for="name">Email</label>
              </div>
              <div class="form-floating mb-3">
                <input class="form-control" name="password" type="password" placeholder="Mots de passe" />
                <label for="name">Mots de passe</label>
              </div>

              <button class="btn btn-primary btn-block" type="submit">S'identifier</button>
              <hr class="my-4">
              <a href="register">Pas de compte ? Inscivez vous ici.</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include_once('libs/footer.php');
