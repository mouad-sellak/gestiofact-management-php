<?php
require_once("ConnexionBD.php");
if (!empty($_POST['Nomclient']) && !empty($_POST['Tel']) && !empty($_POST['Adresse']) && !empty($_POST['Email'])) {
  $Nomclient = htmlspecialchars($_POST['Nomclient']);
  $Numclient = htmlspecialchars($_POST['Numclient']);
  $Tel = htmlspecialchars($_POST['Tel']);
  $Adresse = htmlspecialchars($_POST['Adresse']);
  $Email = htmlspecialchars($_POST['Email']);
  $insertionClient = $pdo->prepare('INSERT INTO client(NomClient,Numclient,Tel,Addresse,Email) VALUES(?,?,?,?,?)');
  $insertionClient->execute(array($Nomclient, $Numclient, $Tel, $Adresse, $Email));
  $alert = "<div class='alert alert-success'><b>Le client  est ajouté avec succès !</b></div>";
  header("refresh:1;url=Clients.php" );
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
            <div class="panel-heading "><h5>Ajouter Client</h5></div>
            <div class="panel-body">
              <?php if (isset($_POST['add'])) echo $alert; ?>
              <form method="POST" method="AjouterClient.php">
                <div class="form-group">
                  <label class="form-label">Nom complet</label>
                  <input type="text" class="form-control" name="Nomclient" required>
                </div>
                <div class="form-group">
                  <label class="form-label">Numero</label>
                  <input type="text" class="form-control" name="Numclient" required>
                </div>
                <div class="form-group">
                  <label class="form-label">Telephone</label>
                  <input type="text" class="form-control" name="Tel" id="d" aria-describedby="emailHelp" required>
                </div>
                <div class="form-group">
                  <label class="form-label">Adresse</label>
                  <input type="text" class="form-control" name="Adresse" id="a" aria-describedby="emailHelp" required>
                </div>
                <div class="form-group">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control" name="Email" id="b" aria-describedby="emailHelp" required>
                </div>
                <input type="submit" class="btn btn-info" value="Valider" name="add" />
                &nbsp;&nbsp;
                <button type="submit" class="btn btn-info">
                  <a href="Clients.php" style="color:white;">&nbsp;Retour</a>
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