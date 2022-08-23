<?php
session_start();
if (isset($_SESSION['user'])) {
    require_once('ConnexionBD.php');
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $etat = isset($_GET['etat']) ? $_GET['etat'] : 0;
    if ($etat == 1)
        $newEtat = 0;
    else
        $newEtat = 1;
    $requete = "update utilisateur set etat=? where id=?";
    $params = array($newEtat, $id);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);
    header("Location:Utilisateurs.php" );
} else {
    header('location:Login.php');
}
