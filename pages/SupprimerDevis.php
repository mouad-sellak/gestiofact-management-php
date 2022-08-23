
<?php
    require_once("ConnexionBD.php");  
    $id = $_GET['IdD']; // get id through query string
    $request ="DELETE from devis where IdD = '$id'"; // delete query
    $resultat=$pdo->query($request);
    header("location:Devis.php");
    exit; 	
   

 