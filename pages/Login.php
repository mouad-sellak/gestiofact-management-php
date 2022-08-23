 <?php
session_start();
if(isset($_SESSION['erreurLogin'])){
  $erreurLogin = $_SESSION['erreurLogin'];
}
else{
  $erreurLogin="";
}
session_destroy();
?> 
<!DOCTYPE html>
<html>


</body>
</html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/LoginStyle.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="../js/ShowPwd.js"></script>  
  </head>
  <body >
    <div class="wrapper">
      <div class="title">Connexion</div>
        <form action="Connexion.php" method="POST">
          <?php if(!empty($erreurLogin)) { ?>
            <div class="alert alert-danger">
              <?php echo $erreurLogin ?>
            </div>
          <?php } ?>
          <div class="field">
            <label>Nom utilisateur :</label>
            <input type="text" name="login" id="login" required>
          </div><br>
          <div class="field">
            <label>Mot de passe : &nbsp;<input type="checkbox" style="width:14px; height:14px;" onclick="ShowOldPwd()">&nbsp;<i class="fas fa-eye fa-1x ShowOldPwd"  ></i></label>
            
            <input type="password" name="pwd" id="OldPwd" required>
          </div><br><br>

          <div class="field">
            <input type="submit" name="save" value="Valider">
          </div>
          <div class="field">
            <a href="InitialiserPwd.php"><strong style="color:white;font-size: 17px;">Mot de passe oublié</strong></a>
            <br>
          </div>
        </form>
    </div>
  </body>
</html> 

