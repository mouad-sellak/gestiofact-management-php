<?php
require_once("ConnexionBD.php");
if (!empty($_POST['NomObjet'])) {
  $Nom = htmlspecialchars($_POST['NomObjet']);
  $insertionClient = $pdo->prepare('INSERT INTO objet(NomObjet) VALUES(?)');
  $insertionClient->execute(array($Nom));
  $alert = "<div class='alert alert-success'><b>L'objet  est ajouté avec succès !</b></div>";
  header("refresh:1;url=Objets.php");
} 
?>
<!DOCTYPE html>
<html>

<head>
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
          <div class="panel panel-info  " style="margin-top:60px">
            <div class="panel-heading "><h5>Ajouter objet</h5></div>
            <div class="panel-body">
            <?php if (isset($_POST['add'])) echo $alert; ?>
              <form method="POST" method="AjouterObjet.php">
                <div class="form-group">
                  <label class="form-label">Nom Objet</label>
                  <input type="text" class="form-control" name="NomObjet" required>
                </div>
                <input type="submit" class="btn btn-info" value="Valider" name="add" />
                &nbsp;&nbsp;
                <button type="submit" class="btn btn-info">
                  <a href="Objets.php" style="color:white;">&nbsp;Retour</a>
                </button>

              </form>
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