<?php
require_once("ConnexionBD.php");
$keyWord = isset($_GET['motCle']) ? $_GET['motCle'] : "";
$size = isset($_GET['size']) ? $_GET['size'] : 3;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;
$requete = "SELECT * from client  where NomClient  like '%$keyWord%' limit $size offset $offset ";
$requeteCount = "select count(*) countC from client where NomClient like '%$keyWord%'  ";
$resultat = $pdo->query($requete);
$resultatCount = $pdo->query($requeteCount);
$tabCount = $resultatCount->fetch();
$nbClients = $tabCount['countC'];
$nbPages = $nbClients % $size == 0 ? $nbClients / $size : floor($nbClients / $size) + 1;
?>
<!DOCTYPE html> 

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="18x18" href="../images/G.png">
    <title>GestioFact</title>
    <?php include("links.php"); ?>

</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <?php include("menu.php"); ?>
            <div class="right_col" role="main" style="background-image: url(../images/home2.jpg);">

                <div class="container">

                    <div class="panel panel-info   " style="margin-top:70px">
                        <div class="panel-heading"><b>Gestion des clients</b></div>

                        <div class="panel-body">
                            <form class="form-inline">
                                <input type="text" name="motCle" placeholder="Nom client" value="<?php echo "$keyWord" ?>">
                                <button type="submit" class="btn btn-info "><span class="glyphicon glyphicon-search"></span> &nbsp;Chercher </button> &nbsp;
                                <a href="AjouterClient.php"><span class="glyphicon glyphicon-plus "></span>Nouveau client</a>
                                &nbsp; &nbsp; &nbsp;
                                <span style="flex:right;">
                                    Montrer
                                    <select name="size" style="color:black;" onchange="this.form.submit()">
                                        <option value="3" <?php if ($size == 3) echo "selected" ?>>3</option>
                                        <option value="5" <?php if ($size == 5) echo "selected" ?>>5</option>
                                        <option value="10" <?php if ($size == 10) echo "selected" ?>>10</option>
                                    </select>
                                    unité
                                </span>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="panel panel-primary  ">
                        <div class="panel-heading "> <b> Liste des clients (<?php echo $nbClients; ?> client) </b> </div>
                        <div class="panel-body ">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>IdClient</th>
                                        <th>NumClient</th>
                                        <th>NomComplet</th>
                                        <th>Telephone</th>
                                        <th>Adresse</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr> `
                                </thead>
                                <tbody>
                                    <?php

                                    while ($data = $resultat->fetch()) {
                                    ?>
                                        <tr>
                                            <td> <?php echo $data['IdC'] ?> </td>
                                            <td> <?php echo $data['NumClient'] ?> </td>
                                            <td> <?php echo $data['NomClient'] ?> </td>
                                            <td> <?php echo $data['Tel'] ?> </td>
                                            <td> <?php echo $data['Addresse'] ?> </td>
                                            <td> <?php echo $data['Email'] ?> </td>
                                            <td>
                                                <a href="ModifierClient.php?IdC=<?php echo $data['IdC']; ?>&page=<?php echo $page ; ?>&motCle=<?php echo "$keyWord"; ?>&size=<?php echo "$size"; ?>"> <span class="glyphicon glyphicon-edit"></span> </a> &nbsp;
                                                <a onclick=" return confirm(' vous confirmez la suppression ?')" href="SupprimerClient.php?IdC=<?php echo $data['IdC']; ?>&page=<?php echo $page ; ?>&motCle=<?php echo "$keyWord"; ?>&size=<?php echo "$size"; ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div>
                                <?php if ($page > 1) { ?>
                                    <a href="Clients.php?page=<?php echo $page - 1; ?>&motCle=<?php echo "$keyWord"; ?>&size=<?php echo "$size"; ?>">Precedent &nbsp; </a>
                                <?php } ?>
                                <ul class="pagination pagination-sm ">
                                    <?php for ($i = $page; $page <= $nbPages - 4 ? $i < $page + 4 : $i <= $nbPages; $i++) { ?>
                                        <li class=" <?php if ($i == $page) echo "active" ?>">
                                            <a href="Clients.php?page=<?php echo $i; ?>&motCle=<?php echo "$keyWord"; ?>&size=<?php echo "$size"; ?>"><?php echo " $i "; ?> &nbsp; &nbsp; </a>
                                        </li>
                                    <?php }  ?>
                                    <?php if ($page < $nbPages) { ?>
                                        <a href="Clients.php?page=<?php echo $page + 1; ?>&motCle=<?php echo "$keyWord"; ?>&size=<?php echo "$size"; ?>">&nbsp; Suivant </a>
                                    <?php }  ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include("footer.php"); ?>
        </div>
    </div>
    <?php include("script.php"); ?>
</body>

</html>