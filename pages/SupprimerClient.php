
<?php
    require_once("Identification.php");  
    require_once("ConnexionBD.php"); 
    $id = $_GET['IdC']; // get id through query string
    $requeteSelect= " DELETE from client where IdC = '$id' "; 
    $pdo->query($requeteSelect);
    header("location:Clients.php?IdC=".$_GET['IdC']."&page=".$_GET['page']."&motCle=".$_GET['motCle']."&size=".$_GET['size']); 
    exit; 	
   
