<?php
require_once('ConnexionBD.php');
require_once('Fonctions.php');
if (isset($_POST['valider'])) {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $email = "";
    }
    $user = rechercher_user_par_email($email);
    if ($user != null) {
        $id = $user['id'];
        $requete = $pdo->prepare("update utilisateur set pass=MD5('1234') where id_user=$id");
        $requete->execute();
        $to = $user['email'];
        $objet = "Initialisation de  votre mot de passe";
        $content = "Votre nouveau mot de passe est 1234, veuillez le modifier à la prochine ouverture de session";
        $entetes = "From: MouSel" . "\r\n" . "CC: mouaadsellak123@gmail.com";
        mail($to, $objet, $content, $entetes);
        $erreur = "non";
        $msg = "Un message contenant votre nouveau mot de passe a été envoyé sur votre adresse Email.";
    } else {
        $erreur = "oui";
        $msg = "<strong>Erreur!</strong> L'Email est incorrecte!!!";
    }
}

?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />
    <title>Initiliser votre mot de passe</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body style="background-image:url('../images/home2.jpg');background-size:cover;" >
    <div class="container col-md-4 col-md-offset-4" style="margin-top:130px;text-align:center;">
        <br>
        <div class="panel panel-info ">
            <div class="panel-heading">
            <h3><strong>Initiliser Mot de Passe</strong></h3>
            </div>
            <div class="panel-body">
                <?php
                if (isset($_POST['valider'])) {
                    if ($erreur == "oui") {
                        echo '<div class="alert alert-danger">' . $msg . '</div>';
                        header("refresh:3;url=InitialiserPwd.php");
                        exit();
                    } elseif ($erreur == "non") {
                        echo '<div class="alert alert-success">' . $msg . '</div>';
                        header("refresh:3;url=Login.php");
                        exit();
                    }
                }
                ?>
                <form method="post" class="form">
                    <div class="form-group">
                        <label class="control-label">
                            Email:
                        </label>
                        <input type="email" name="email" class="form-control" />
                    </div>
                    <button type="submit" name="valider" class="btn btn-info">Valider</button>
                    <button type="submit" class="btn btn-info">
                        <a href="Login.php" style="color:white;">&nbsp;Retour</a>
                    </button>

                </form>
            </div>
        </div>
    </div>
</body>

</html>