<?php
require_once("ConnexionBD.php");
require_once("Fonctions.php");
$validationErrors = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];




  $email = $_POST['email'];
  $login = $_POST['login'];
  $pwd1 = $_POST['mdp'];
  $pwd2 = $_POST['mdpConfi'];


  if (isset($login)) { 
    $filtredLogin = filter_var($login, FILTER_SANITIZE_STRING);
    if (strlen($filtredLogin) < 4) {
      $validationErrors[] = " Le login doit contenir au moins 4 caratères !";
    }
  }
  if (isset($pwd1) && isset($pwd2)) {
    if (empty($pwd1)) {
      $validationErrors[] = " Le mot ne doit pas etre vide !";
    }
    if (md5($pwd1) !== md5($pwd2)) {
      $validationErrors[] = "Les deux mot de passe ne sont pas identiques !";
    }
  }
  if (isset($email)) {
    $filtredEmail = filter_var($login, FILTER_SANITIZE_EMAIL);
    if ($filtredEmail != true) {
      $validationErrors[] = " Email  non valid !";
    }
  }
  if (empty($validationErrors)) {
    if (rechercher_par_login($login) == 0 & rechercher_par_email($email) == 0) {
      $requete = $pdo->query("INSERT INTO utilisateur(nom,prenom,login,role,etat,email,pwd) VALUES( '$nom','$prenom','$login','Visiteur',0,'$email',MD5('$pwd1'))");
      $success_msg = "Le compte est crée, avec succès !";
    } else {
      if (rechercher_par_login($login) > 0) {
        $validationErrors[] = 'Désolé le login exsite deja';
      }
      if (rechercher_par_email($email) > 0) {
        $validationErrors[] = 'Désolé cet email exsite deja';
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" sizes="18x18" href="../images/G.png">
  <title>GestioFactV2</title>
  <?php include("links.php"); ?>
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <?php include("menu.php"); ?>
      <div class="right_col" role="main" style="background-image: url(../images/home2.jpg);">

        <div class="container  ">
            <div class="panel panel-info col-md-8 col-md-offset-2 " >
              <div class="panel-heading">
                <h3><strong>Nouveau Compte Utilisateur</strong></h3>
              </div>
              <div class="panel-body">
                <?php

                if (isset($validationErrors) && !empty($validationErrors)) {
                  foreach ($validationErrors as $error) {
                    echo '<div class="alert alert-danger">' . $error . '</div>';
                  }
                }


                if (isset($success_msg) && !empty($success_msg)) {
                  echo '<div class="alert alert-success">' . $success_msg . '</div>';


                }

                ?>
                <form method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="login"><strong>Nom:</strong></label>
                    <input type="text" name="nom" class="form-control" autocomplete="off" />
                  </div>
                  <div class="form-group">
                    <label for="login"><strong>Prenom:</strong></label>
                    <input type="text" name="prenom" class="form-control" autocomplete="off" />
                  </div>

                  <div class="form-group">
                    <label for="email"><strong>email :</strong></label>
                    <input type="email" name="email" class="form-control" autocomplete="off" />
                  </div>
                  <div class="form-group">
                    <label for="login"><strong>Login :</strong></label>
                    <input type="text" name="login" class="form-control" autocomplete="off" />
                  </div>

                  <div class="form-group">
                    <label for="pwd"><strong>Mot de passe :</strong></label>
                    <input type="password" name="mdp" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label for="pwdConfi"><strong>Confirmer mot de passe :</strong></label>
                    <input type="password" name="mdpConfi" class="form-control" />
                  </div>
                  <button type="submit" class="btn btn-info" name="valider">
                    <span class="glyphicon glyphicon-log-in"></span>
                    <strong>Valider</strong>
                  </button>
                  &nbsp;&nbsp;&nbsp;
                  <button type="submit" class="btn btn-info">
                    <a href="Utilisateurs.php" style="color:white;">&nbsp;Retour</a>
                  </button>

                  <br><br>
                </form>
              </div>
            </div>
          </div>
          </div>

    </div>


    <?php include("footer.php"); ?>
  </div>
  </div>
  <?php include("script.php"); ?>
</body>

</html>
