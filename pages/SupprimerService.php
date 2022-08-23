
<?php
require_once("ConnexionBD.php");  
$id = $_GET['idS']; // get id through query string
$requete=" DELETE from service where idS = '$id' "; // delete query
$resultat=$pdo->query($requete);
header("location:Services.php?idS=".$_GET['idS']."&page=".$_GET['page']."&motCle=".$_GET['motCle']."&size=".$_GET['size']); // redirects to all records page
exit; 	 
