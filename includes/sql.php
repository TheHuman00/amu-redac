<?php
require_once('includes/load.php');

/*--------------------------------------------------------------*/
/* Fonction de recherche de toutes les lignes de table de base de données par nom de table
/*--------------------------------------------------------------*/
function find_all($table)
{
  global $db;
  if (tableExists($table)) {
    return find_by_sql("SELECT * FROM " . $db->escape($table));
  }
}

/*--------------------------------------------------------------*/
/* Fonction pour effectuer des requêtes
/*--------------------------------------------------------------*/
function find_by_sql($sql)
{
  global $db;
  $result = $db->query($sql);
  $result_set = $db->while_loop($result);
  return $result_set;
}

/*--------------------------------------------------------------*/
/*  Fonction de recherche des données de la table par identifiant
/*--------------------------------------------------------------*/
function find_by_id($table, $id)
{
  global $db;
  $id = (int)$id;
  if (tableExists($table)) {
    $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id='{$db->escape($id)}' LIMIT 1");
    if ($result = $db->fetch_assoc($sql))
      return $result;
    else
      return null;
  }
}
/*--------------------------------------------------------------*/
/* Fonction pour supprimer les données de la table par identifiant
/*--------------------------------------------------------------*/
function delete_by_id($table, $id)
{
  global $db;
  if (tableExists($table)) {
    $sql = "DELETE FROM " . $db->escape($table);
    $sql .= " WHERE id=" . $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
  }
}
/*--------------------------------------------------------------*/
/* Fonction pour Count id par table name
/*--------------------------------------------------------------*/

function count_by_id($table)
{
  global $db;
  if (tableExists($table)) {
    $sql    = "SELECT COUNT(id) AS total FROM " . $db->escape($table);
    $result = $db->query($sql);
    return ($db->fetch_assoc($result));
  }
}
/*--------------------------------------------------------------*/
/* Déterminer si la table de base de données existe
/*--------------------------------------------------------------*/
function tableExists($table)
{
  global $db;
  $table_exit = $db->query('SHOW TABLES FROM ' . DB_NAME . ' LIKE "' . $db->escape($table) . '"');
  if ($table_exit) {
    if ($db->num_rows($table_exit) > 0)
      return true;
    else
      return false;
  }
}

/*--------------------------------------------------------------*/
/* Connectez-vous avec les données fournies dans $_POST,
/* provenant du formulaire de connexion.
/*--------------------------------------------------------------*/
function authenticate($username = '', $password = '')
{
  global $db;
  $database = new MySqli_DB();
  $username = $db->escape($username);
  $password = $db->escape($password);
  $sql  = $database->db_prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
  $sql->bind_param('s', $username);
  $sql->execute();
  $sql_result = $sql->get_result();
  if ($db->num_rows($sql_result)) {
    $user = $db->fetch_assoc($sql_result);
    if (password_verify($password, $user['password'])) {
      return $user['id'];
    }
  }
  return false;
}
/*--------------------------------------------------------------*/
/* Connectez-vous avec les données fournies dans $ _POST,
/* provenant du formulaire login_v2.php.
/* Si vous avez utilisé cette méthode, supprimez la fonction d'authentification.
/*--------------------------------------------------------------*/
function authenticate_v2($username = '', $password = '')
{
  global $db;
  $database = new MySqli_DB();
  $username = $db->escape($username);
  $password = $db->escape($password);
  $sql  = $database->db_prepare("SELECT id,username,password,user_level FROM users WHERE username = ? LIMIT 1");
  $sql->bind_param('s', $username);
  $sql_result = $sql->get_result();
  $result = $sql->execute();
  if ($db->num_rows($sql_result)) {
    $user = $db->fetch_assoc($sql_result);
    if (password_verify($password, $user['password'])) {
      return $user;
    }
  }
  return false;
}


/*--------------------------------------------------------------*/
/* Rechercher l'utilisateur de connexion actuel par identifiant de session
  /*--------------------------------------------------------------*/
function current_user()
{
  static $current_user;
  global $db;
  if (!$current_user) {
    if (isset($_SESSION['user_id'])) :
      $user_id = intval($_SESSION['user_id']);
      $current_user = find_by_id('users', $user_id);
    endif;
  }
  return $current_user;
}
/*--------------------------------------------------------------*/
/* Trouver tous les utilisateurs par
  /* Rejoindre la table des utilisateurs et la table des groupes d'utilisateurs
  /*--------------------------------------------------------------*/
function find_all_user()
{
  global $db;
  $results = array();
  $sql = "SELECT u.id,u.name,u.username,u.user_level,u.status,u.email,u.telephone,u.competence,u.admin,u.permis,u.cle,";
  $sql .= "g.group_name ";
  $sql .= "FROM users u ";
  $sql .= "LEFT JOIN user_groups g ";
  $sql .= "ON g.group_level=u.user_level ORDER BY u.name ASC";
  $result = find_by_sql($sql);
  return $result;
}
/*--------------------------------------------------------------*/
/* Fonction pour mettre à jour la dernière connexion d'un utilisateur
  /*--------------------------------------------------------------*/

function updateLastLogIn($user_id)
{
  global $db;
  date_default_timezone_set($timeZone);
  $date2 = date_create();
  $date = date_format($date2, 'Y-m-d H:i');
  $sql = "UPDATE users SET email='{$date}' WHERE id ='{$user_id}' LIMIT 1";
  $result = $db->query($sql);
  return ($result && $db->affected_rows() === 1 ? true : false);
}
/*--------------------------------------------------------------*/
/* Trouver le niveau du groupe
  /*--------------------------------------------------------------*/
function find_by_groupLevel($level)
{
  global $db;
  $sql = "SELECT group_level FROM user_groups WHERE group_level = '{$db->escape($level)}' LIMIT 1 ";
  $result = $db->query($sql);
  return ($db->num_rows($result) === 0 ? true : false);
}
/*--------------------------------------------------------------*/
/* Fonction pour vérifier quel niveau d'utilisateur a accès à la page
  /*--------------------------------------------------------------*/
function page_require_level($require_level)
{
  global $session;
  $current_user = current_user();
  $login_level = find_by_groupLevel($current_user['user_level']);
  //if user not login
  if (!$session->isUserLoggedIn(true)) :
    $session->msg('d', 'Connectez vous...');
    redirect('index', false);
  //if Group status Deactive
  /*      elseif($login_level['group_status'] === '0'):
           $session->msg('d','Cet utilisateur de niveau a été banni!');
           redirect('index',false);
      //cheackin log in User level and Require level is Less than or equal to */
  elseif ($current_user['user_level'] <= (int)$require_level) :
    return true;
  else :
    $session->msg("d", "Vous n'êtes pas autorisé à afficher la page.");
    redirect('index', false);
  endif;
}
/*--------------------------------------------------------------*/
/* Fonction de recherche de tous les noms de produits 
   /* JOIN avec catégorie et table de base de données des médias
   /*--------------------------------------------------------------*/

function trouver_mission($id_rapport, $mission)
{
  global $db;
  $sql = $db->query(" SELECT * FROM missions_ambu WHERE id_rapports ='{$id_rapport}' AND id_mission ='{$mission}'");
  if ($result = $db->fetch_assoc($sql)) {
    return $result;
  } else {
    return null;
  }
}

function trouver_rapport($id_rapport)
{
  global $db;
  $sql = $db->query(" SELECT * FROM rapports WHERE id ='{$id_rapport}'");
  if ($result = $db->fetch_assoc($sql)) {
    return $result;
  } else {
    return null;
  }
}


function trouver_mission_smur($id_rapport, $mission)
{
  global $db;
  $sql = $db->query(" SELECT * FROM missions_smur WHERE id_rapports ='{$id_rapport}' AND id_mission ='{$mission}'");
  if ($result = $db->fetch_assoc($sql)) {
    return $result;
  } else {
    return null;
  }
}

function count_mission_fini($id_rapport)
{
  global $db;
  $count = 0;
  $sql = $db->query("SELECT fini FROM missions_ambu WHERE id_rapports ='{$id_rapport}'");
  while ($resultat = $db->fetch_assoc($sql)) {
    if ($resultat['fini'] == 'true') {
      $count++;
    }
  }
  return $count;
}

function trouver_titre_mission($id_rapport, $mission)
{
  global $db;
  $sql = $db->query(" SELECT title FROM missions_ambu WHERE id_rapports ='{$id_rapport}' AND id_mission ='{$mission}'");
  if ($result = $db->fetch_assoc($sql)) {
    $base64 = implode($result);
    return base64_decode($base64);
  } else {
    return null;
  }
}

function count_mission_fini_smur($id_rapport)
{
  global $db;
  $count = 0;
  $sql = $db->query("SELECT fini FROM missions_smur WHERE id_rapports ='{$id_rapport}'");
  while ($resultat = $db->fetch_assoc($sql)) {
    if ($resultat['fini'] == 'true') {
      $count++;
    }
  }
  return $count;
}

function trouver_titre_mission_smur($id_rapport, $mission)
{
  global $db;
  $sql = $db->query(" SELECT title FROM missions_smur WHERE id_rapports ='{$id_rapport}' AND id_mission ='{$mission}'");
  if ($result = $db->fetch_assoc($sql)) {
    $base64 = implode($result);
    return base64_decode($base64);
  } else {
    return null;
  }
}

function join_user_table()
{
  global $db;
  $sql  = " SELECT p.id,p.name,p.username";
  $sql  .= " FROM users p";
  $sql  .= " ORDER BY p.name ASC";
  return find_by_sql($sql);
}

function join_user_table2()
{
  global $db;
  $sql  = " SELECT *";
  $sql  .= " FROM users p";
  $sql  .= " ORDER BY p.name ASC";
  return find_by_sql($sql);
}


function find_user_by_title($event_name)
{
  global $db;
  $p_event = remove_junk($db->escape($event_name));
  $sql = "SELECT * FROM users WHERE name='{$p_event}'";
  $result = $db->query($sql);
  $result2 = $db->fetch_assoc($result);
  return $result2;
}