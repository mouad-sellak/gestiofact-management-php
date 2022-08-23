
<?php
    require_once("ConnexionBD.php");  
    $id = $_GET['IdF']; // get id through query string
    $request ="DELETE from facture where IdF = '$id'"; // delete query
    $resultat=$pdo->query($request);
    $tab=$resultat->fetch();
    $idO=$tab['IdO'];
    header("location:Factures.php"); 
    exit;	

