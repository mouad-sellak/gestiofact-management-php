<?php
require_once("ConnexionBD.php");
$id = $_GET['idS']; // get id through query string
$requete = " SELECT * from service where idS='$id'"; // select query
$resultat = $pdo->query($requete);
$data = $resultat->fetch();
if (isset($_POST['update'])) // when click on Update button
{
  $Designation = $_POST['Designation'];
  $Prix = $_POST['Prix'];
  $requeteModifier = "UPDATE service set Designation='$Designation',Prix='$Prix' where idS='$id'";
  $resultatModifier = $pdo->query($requeteModifier);
  $alert = "<div class='alert alert-success'><b>Le service est modifié avec succès !</b></div>";
  header("refresh:0.5;url=Services.php?idS=".$_GET['idS']."&page=".$_GET['page']."&motCle=".$_GET['motCle']."&size=".$_GET['size'] );
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
          <div class="panel panel-info " style=" margin-top:6%; ">
            <div class="panel-heading "><h5>Modifier Service</h5></div>
            <div class="panel-body">
              <?php if (isset($_POST['update'])) echo $alert; ?>
              <form method="POST">
                <div class="form-group">
                  <label class="form-label">Designation</label>
                  <input value="<?php echo $data['Designation'] ?>" type="text" class="form-control" name="Designation">
                </div> 
                <div class="form-group">
                  <label class="form-label">Prix</label>
                  <input value="<?php echo $data['Prix'] ?>" type="text" class="form-control" name="Prix" id="d">
                </div>
                <input type="submit" class="btn btn-info" value="Valider" name="update" />
                &nbsp;&nbsp;
                <button type="submit" class="btn btn-info">
                  <a href="Services.php?idS=<?php echo $_GET['idS']; ?>&page=<?php echo$_GET['page'] ; ?>&motCle=<?php echo $_GET['motCle']; ?>&size=<?php echo $_GET['size']; ?>" style="color:white;">&nbsp;Retour</a>
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