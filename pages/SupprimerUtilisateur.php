<?php
     session_start();
    if(isset($_SESSION['user'])){
        
            require_once('ConnexionBD.php');
            
            $idUser=isset($_GET['idUser'])?$_GET['idUser']:0;

            $requete="delete from utilisateur where id=?";
            
            $params=array($idUser);
            
            $resultat=$pdo->prepare($requete);
            
            $resultat->execute($params);
            
            header('location:Utilisateurs.php');   
            
     }else {
                header('location:Login.php');
        }
    
?>