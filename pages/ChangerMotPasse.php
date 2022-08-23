<?php

require_once("ConnexionBD.php");
$id = $_GET['id'];
$requeteSelect = "SELECT * from utilisateur WHERE id=$id";
$resultatSelect = $pdo->query($requeteSelect);
$data = $resultatSelect->fetch(); // fetch data
if (isset($_POST['change'])) { // when click on Update button
  $OldPwd = $_POST['OldPwd'];
  $NewPwd = $_POST['NewPwd'];
  $NewPwdConfi = $_POST['NewPwdConfi'];
  if ($OldPwd == $data['pwd'] && $NewPwd == $NewPwdConfi) {
    $requeteModifier = "UPDATE utilisateur set pwd='$NewPwd' where id='$id'";
    $resultatModifier = $pdo->query($requeteModifier);
    echo "<div class='alert alert-success'><b>Le mot de passe est modifié avec succès !</b></div>";
    header("refresh:2;url=" . $_SERVER['HTTP_REFERER']);
  } else {
    echo "<div class='alert alert-danger'><b>Erreur de changement de mot de passe !</b></div>";
    header("refresh:2;url=" . $_SERVER['HTTP_REFERER']);
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
        <div class="container">
          <div class="panel panel-info col-md-10 col-md-offset-1  " >
            <div class="panel-heading ">Changer mot de passe :</div>
            <div class="panel-body">
              <form method="POST">
                <div class="form-group">
                  <label class="form-label">Ancien mot de passe : </label>
                  &nbsp;<input type="checkbox" onclick="ShowOldPwd()">&nbsp;<i class="fas fa-eye fa-1x ShowOldPwd"></i>
                  <input type="password" class="form-control OldPwd" id="OldPwd" name="OldPwd" required>
                </div>
                <div class="form-group">
                  <label class="form-label">Nouveau mot de passe :</label>
                  &nbsp;<input type="checkbox" onclick="ShowNewPwd()">&nbsp;<i class="fas fa-eye fa-1x ShowNewPwd "></i>
                  <input type="password" class="form-control NewPwd" id="NewPwd" name="NewPwd" required>
                </div>
                <div class="form-group">
                  <label class="form-label">Confirmer le nouveau mot de passe :</label>
                  &nbsp;<input type="checkbox" onclick="ShowNewPwdConfi()">&nbsp;<i class="fas fa-eye fa-1x ShowNewPwdConfi"></i>
                  <input type="password" class="form-control NewPwdConfi" id="NewPwdConfi" name="NewPwdConfi" required>
                </div>
                <input type="submit" class="btn btn-primary" value="Valider" name="change" />
                <a href="ModifierUtilisateur.php?id=<?php echo $_SESSION['user']['id']; ?>"><b>&nbsp;Retour</b></a>
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