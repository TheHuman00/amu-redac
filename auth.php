<?php include_once('includes/load.php'); ?>
<?php
$username = remove_junk($_POST['email']);
$password = remove_junk($_POST['password']);

  $user_id = authenticate($username, $password);
  if($user_id){
     $session->login($user_id);
     redirect('index',false);

  } else {
    $session->msg('s', "Pas le bon email et/ou mots de passe");
    redirect('login',false);
  }


?>
