<?php
require_once("ConnexionBD.php");
if (!empty($_POST['Designation']) && !empty($_POST['Prix'])) {
  $Designation = htmlspecialchars($_POST['Designation']);
  $Prix = htmlspecialchars($_POST['Prix']);
  $insertionClient = $pdo->prepare('INSERT INTO service(Designation,Prix) VALUES(?,?)');
  $insertionClient->execute(array($Designation, $Prix));
  $alert = "<div class='alert alert-success'><b>Le service est ajouté avec succès !</b></div>";
  header("refresh:1;url=Services.php");
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
          <div class="panel panel-info   " style="margin-top: 6%;">
            <div class="panel-heading ">
              <h5>Ajouter Service</h5>
            </div>
            <div class="panel-body">
              <?php if (isset($_POST['add'])) echo $alert; ?>
              <form action="AjouterService.php" method="POST">
                <div class="form-group">
                  <label class="form-label">Designation</label>
                  <input type="text" class="form-control" name="Designation" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                  <label class="form-label">Prix(DH)</label>
                  <input type="number" class="form-control" name="Prix" id="d" aria-describedby="emailHelp">
                </div>
                <input type="submit" class="btn btn-info" value="Valider" name="add" />
                &nbsp;&nbsp;
                <button type="submit" class="btn btn-info">
                  <a href="Services.php" style="color:white;">&nbsp;Retour</a>
                </button </form>
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
</script>