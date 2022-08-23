<?php
require_once("ConnexionBD.php");
$id = $_GET['IdC']; // get id through query string
$requeteSelect = "SELECT * from client where IdC='$id'"; // select query
$resultatSelect = $pdo->query($requeteSelect);
$data = $resultatSelect->fetch(); // fetch data
if (isset($_POST['update'])) { // when click on Update button
  $Nomclient = $_POST['Nomclient'];
  $Numclient = $_POST['Numclient'];
  $Tel = $_POST['Tel'];
  $Adresse = $_POST['Adresse'];
  $Email = $_POST['Email'];
  $requeteModifier = "UPDATE client set NomClient='$Nomclient',Tel='$Tel',Addresse='$Adresse',Email='$Email', NumClient='$Numclient' where IdC='$id'";
  $resultatSelect = $pdo->query($requeteModifier);
  $alert = "<div class='alert alert-success'><b>Le client  est modifié avec succès !</b></div>";
  header("refresh:0.5;url=Clients.php?IdC=".$_GET['IdC']."&page=".$_GET['page']."&motCle=".$_GET['motCle']."&size=".$_GET['size'] );
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
          <div class="panel panel-info " style="margin-top: 70px;">
            <div class="panel-heading "><h5>Modifier Client</h5></div>
            <div class="panel-body">
              <?php if (isset($_POST['update'])) echo $alert; ?>
              <form method="POST" method="ModifierClient.php">
                <div class="form-group">
                  <label class="form-label">Nom complet</label>
                  <input value="<?php echo $data['NomClient'] ?>"type="text" class="form-control" name="Nomclient" required>
                </div>
                <div class="form-group">
                  <label class="form-label">Numero</label>
                  <input value="<?php echo $data['NumClient'] ?>" type="text" class="form-control" name="Numclient" required>
                </div>
                <div class="form-group">
                  <label class="form-label">Telephone</label>
                  <input value="<?php echo $data['Tel'] ?>" type="text" class="form-control" name="Tel" id="d" aria-describedby="emailHelp" required>
                </div>
                <div class="form-group">
                  <label class="form-label">Adresse</label>
                  <input value="<?php echo $data['Addresse'] ?>" type="text" class="form-control" name="Adresse" id="a" aria-describedby="emailHelp" required>
                </div>
                <div class="form-group">
                  <label class="form-label">Email</label>
                  <input value="<?php echo $data['Email'] ?>" type="email" class="form-control" name="Email" id="b" aria-describedby="emailHelp" required>
                </div>
                <input type="submit" class="btn btn-info" value="Valider" name="update" />
                &nbsp;&nbsp;
                <button type="submit" class="btn btn-info">
                  <a href="Clients.php?IdC=<?php echo $_GET['IdC']; ?>&page=<?php echo$_GET['page'] ; ?>&motCle=<?php echo $_GET['motCle']; ?>&size=<?php echo $_GET['size']; ?>" style="color:white;">&nbsp;Retour</a>
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