<?php
  session_start();
  require_once("ConnexionBD.php");
// Check The Type Request Is Post Not Get
  if(isset($_SERVER['REQUEST_METHOD']) == "POST") {
   // After Click Botton Submit
    if(isset($_POST['save'])) {
     $login = $_POST['login'];
     $pwd=$_POST['pwd'];
     // check Input Is Empty Or Not Empty
     if(empty($login) || empty($pwd)) {
       echo "Completez vos champs !!";
       // Check Email Is Email Or No 
     }else { 
       // Check The Info
       $requete = "SELECT * FROM utilisateur WHERE login='$login' and pwd=MD5('$pwd')";
       $resultat=$pdo->query($requete);
       if($user = $resultat->fetch()){
        if($user['etat']==1){
            
            $_SESSION['user']=$user;
            header('location:Accueil.php');
            
        }else{
            
            $_SESSION['erreurLogin']="<strong>Erreur!!</strong> Votre compte est désactivé.<br> Veuillez contacter l'administrateur";
            header('location:Login.php');
        }
       }
       else {
          $_SESSION['erreurLogin']="<strong>Login ou mot de passe incorrect !!</strong>";
          header("Location:Login.php"); 
       }
     } 
   }
  }
?>