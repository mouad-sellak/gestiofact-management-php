<?php
    require_once("ConnexionBD.php");   
    $id = $_GET['IdO']; // get id through query string
    $requeteSupp="DELETE FROM objet where IdO ='$id'";
    $resultatSupp=$pdo->query($requeteSupp);
    header("location:Objets.php?IdO=".$_GET['IdO']."&page=".$_GET['page']."&motCle=".$_GET['motCle']."&size=".$_GET['size']);
    exit; 
?>



