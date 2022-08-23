<?php
require_once("ConnexionBD.php");
$id = $_GET['IdO']; // get id through query string
$requeteSelect = "SELECT * from objet WHERE IdO=  $id";
$resultatSelect = $pdo->query($requeteSelect); // select query
$data = $resultatSelect->fetch(); // fetch data
if (isset($_POST['update'])) { // when click on Update button
  $Nomobjet = $_POST['NomObjet'];
  $requeteModifier = "update objet set NomObjet='$Nomobjet' where IdO='$id'";
  $resultatModifier = $pdo->query($requeteModifier);
  $alert = "<div class='alert alert-success'><b>L'objet  est modifié avec succès !</b></div>";
  header("refresh:0.5;url=Objets.php?IdO=".$_GET['IdO']."&page=".$_GET['page']."&motCle=".$_GET['motCle']."&size=".$_GET['size'] );
}
?>

<!DOCTYPE html>
<html>

<head> 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" sizes="18x18" href="../images/G.png">
  <title>GestioFact</title>
  <?php include("links.php"); ?>
</head>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <?php include("menu.php"); ?>
      <div class="right_col" role="main" style="background-image: url(../images/home2.jpg);">
      <div class="container">
    <div class="panel panel-info  " style="margin-top: 10%;">
      <div class="panel-heading "><h5>Modifier objet</h5></div>
      <div class="panel-body">
      <?php if (isset($_POST['update'])) echo $alert; ?>
        <form method="POST">
          <div class="form-group">
            <label class="form-label">Nom objet</label>
            <input value="<?php echo $data['NomObjet']; ?>" type="text" class="form-control" name="NomObjet" required>
          </div> 
          <input type="submit" class="btn btn-info" value="Valider" name="update" />
          &nbsp;&nbsp;
          <button type="submit" class="btn btn-info">
            <a href="Objets.php?IdO=<?php echo $_GET['IdO']; ?>&page=<?php echo$_GET['page'] ; ?>&motCle=<?php echo $_GET['motCle']; ?>&size=<?php echo $_GET['size']; ?>" style="color:white;">&nbsp;Retour</a>
          </button>
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