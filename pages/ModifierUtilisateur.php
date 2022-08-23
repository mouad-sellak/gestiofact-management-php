<?php
  require_once("ConnexionBD.php"); 
  $id = $_GET['id'];
  $requeteSelect="SELECT * from utilisateur WHERE id=$id";
  $resultatSelect = $pdo->query($requeteSelect); 
  $data = $resultatSelect->fetch(); // fetch data
  if(isset($_POST['update'])){ // when click on Update button
    $Nom = $_POST['NomUtilisateur'];
    $Email = $_POST['Email'];
    $requeteModifier = "UPDATE utilisateur set nom='$Nom', email='$Email' where id='$id'";
    $resultatModifier = $pdo->query($requeteModifier);
    echo "<div class='alert alert-success'><b>La mise à jour est faite avec succès !</b></div>"; 
    header("refresh:2;url=".$_SERVER['HTTP_REFERER']);  
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
          <div class="panel panel-info col-md-10 col-md-offset-1  " style="margin-top: 6%;">
              <div class="panel-heading " >Modifier utilisateur</div>
                <div class="panel-body">
                  <form  method="POST" >
                    <div class="form-group">
                      <label class="form-label">Nom utilisateur : </label>
                      <input value="<?php echo $data['nom'] ;?>" type="text" class="form-control" name="NomUtilisateur"  required>
                    </div>
                    <div class="form-group">
                      <label  class="form-label">Email :</label>
                      <input value="<?php echo $data['email'] ?>" type="email" class="form-control" name="Email"  required>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Valider" name="update"/>
                    &nbsp;
                    <a href="ChangerMotPasse.php?id=<?php echo $_SESSION['user']['id']; ?>"><b>Changer le mot de passe<b></a>
                    <a href="Accueil.php" ><b style="position:relative;left:63%">&nbsp;Retour</b></a>
                  </form>
                </div>
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




