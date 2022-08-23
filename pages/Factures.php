<?php
require_once("ConnexionBD.php");
$keyWord = isset($_GET['motCle']) ? $_GET['motCle'] : "";
$size = isset($_GET['size']) ? $_GET['size'] : 3;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;
$Periode = isset($_GET['periode']) ? $_GET['periode'] : "Tous";
$DateActuelle = date("Y-m-d ", strtotime("today"));
$Trimestre = date("Y-m-d ", strtotime("+3 Months"));
$TrimestrePre = date("Y-m-d ", strtotime("-3 Months"));
$Semestre = date("Y-m-d ", strtotime("+6 Months"));
$SemestrePre = date("Y-m-d ", strtotime("-6 Months"));
$Annee = date("Y-m-d ", strtotime("+12 Months"));
$AnneePre = date("Y-m-d ", strtotime("-12 Months"));
$requeteCountNbServ = "SELECT service.IdS,count(*) countS from service inner join appartenance ON appartenance.IdS=service.IdS INNER JOIN objet ON appartenance.IdO=objet.IdO INNER JOIN facture ON facture.IdO=objet.IdO group by service.IdS";
$resultatCountNbServ = $pdo->query($requeteCountNbServ);
$tabCountNbServ = $resultatCountNbServ->fetch();
if ($Periode == "Tous") {
    $requete = " SELECT facture.IdF,facture.MontantTTC,facture.etat,facture.IdO,facture.dateFac,facture.typePay,objet.NomObjet,objet.IdO,client.NomClient,client.IdC from facture 
    inner join client on client.IdC=facture.IdC inner join objet on objet.IdO=facture.IdO  where typePay  like '%$keyWord%'  ORDER BY dateFac limit $size offset $offset ";
    $resultat = $pdo->query($requete);
    $data = $resultat->fetchAll();
    $requeteCountNbFact = "SELECT count(*) countF from facture  where typePay  like '%$keyWord%'   ";
    $resultatCountNbFact = $pdo->query($requeteCountNbFact);
    $tabCountNbFact = $resultatCountNbFact->fetch();
    $nbFactures = $tabCountNbFact['countF'];
    $nbPages = $nbFactures % $size == 0 ? $nbFactures / $size : floor($nbFactures / $size) + 1;
} else if ($Periode == "TriCou") {
    $requete = " SELECT facture.IdF,facture.MontantTTC,facture.etat,facture.IdO,facture.dateFac,facture.typePay,objet.NomObjet,objet.IdO,client.NomClient,client.IdC from facture 
    inner join client on client.IdC=facture.IdC inner join objet on objet.IdO=facture.IdO  where (typePay  like '%$keyWord%') and (dateFac BETWEEN '$DateActuelle' AND '$Trimestre')   ORDER BY dateFac limit $size offset $offset ";
    $resultat = $pdo->query($requete);
    $data = $resultat->fetchAll();
    $requeteCountNbFact = "SELECT count(*) countF from facture where typePay  like '%$keyWord%' and  dateFac BETWEEN '$DateActuelle' AND '$Trimestre'    ";
    $resultatCountNbFact = $pdo->query($requeteCountNbFact);
    $tabCountNbFact = $resultatCountNbFact->fetch();
    $nbFactures = $tabCountNbFact['countF'];
    $nbPages = $nbFactures % $size == 0 ? $nbFactures / $size : floor($nbFactures / $size) + 1;
} else if ($Periode == "TriPre") {
    $requete = " SELECT facture.IdF,facture.MontantTTC,facture.etat,facture.IdO,facture.dateFac,facture.typePay,objet.NomObjet,objet.IdO,client.NomClient,client.IdC from facture 
    inner join client on client.IdC=facture.IdC inner join objet on objet.IdO=facture.IdO  where (typePay  like '%$keyWord%') and (dateFac BETWEEN  '$TrimestrePre' AND '$DateActuelle')   ORDER BY dateFac limit $size offset $offset ";
    $requeteCountNbFact = "SELECT count(*) countF from facture where typePay  like '%$keyWord%' and  dateFac BETWEEN '$TrimestrePre'  AND '$DateActuelle'    ";
    $resultat = $pdo->query($requete);
    $data = $resultat->fetchAll();
    $resultatCountNbFact = $pdo->query($requeteCountNbFact);
    $tabCountNbFact = $resultatCountNbFact->fetch();
    $nbFactures = $tabCountNbFact['countF'];
    $nbPages = $nbFactures % $size == 0 ? $nbFactures / $size : floor($nbFactures / $size) + 1;
} else if ($Periode == "SemCou") {
    $requete = " SELECT facture.IdF,facture.MontantTTC,facture.etat,facture.IdO,facture.dateFac,facture.typePay,objet.NomObjet,objet.IdO,client.NomClient,client.IdC from facture 
    inner join client on client.IdC=facture.IdC inner join objet on objet.IdO=facture.IdO  where (typePay  like '%$keyWord%') and (dateFac BETWEEN '$DateActuelle' AND '$Semestre')   ORDER BY dateFac limit $size offset $offset ";
    $requeteCountNbFact = "SELECT count(*) countF from facture where typePay  like '%$keyWord%' and  dateFac  BETWEEN '$DateActuelle' AND '$Semestre'    ";
    $resultat = $pdo->query($requete);
    $data = $resultat->fetchAll();
    $resultatCountNbFact = $pdo->query($requeteCountNbFact);
    $tabCountNbFact = $resultatCountNbFact->fetch();
    $nbFactures = $tabCountNbFact['countF'];
    $nbPages = $nbFactures % $size == 0 ? $nbFactures / $size : floor($nbFactures / $size) + 1;
} else if ($Periode == "SemPre") {
    $requete = " SELECT facture.IdF,facture.MontantTTC,facture.etat,facture.IdO,facture.dateFac,facture.typePay,objet.NomObjet,objet.IdO,client.NomClient,client.IdC from facture 
    inner join client on client.IdC=facture.IdC inner join objet on objet.IdO=facture.IdO  where (typePay  like '%$keyWord%') and (dateFac BETWEEN '$SemestrePre' AND '$DateActuelle')   ORDER BY dateFac limit $size offset $offset ";
    $requeteCountNbFact = "SELECT count(*) countF from facture where typePay  like '%$keyWord%' and  dateFac  BETWEEN '$SemestrePre' AND '$DateActuelle'    ";
    $resultat = $pdo->query($requete);
    $data = $resultat->fetchAll();
    $resultatCountNbFact = $pdo->query($requeteCountNbFact);
    $tabCountNbFact = $resultatCountNbFact->fetch();
    $nbFactures = $tabCountNbFact['countF'];
    $nbPages = $nbFactures % $size == 0 ? $nbFactures / $size : floor($nbFactures / $size) + 1;
} else if ($Periode == "AnnCou") {
    $requete = " SELECT facture.IdF,facture.MontantTTC,facture.etat,facture.IdO,facture.dateFac,facture.typePay,objet.NomObjet,objet.IdO,client.NomClient,client.IdC from facture 
    inner join client on client.IdC=facture.IdC inner join objet on objet.IdO=facture.IdO  where (typePay  like '%$keyWord%') and (dateFac BETWEEN '$DateActuelle' AND '$Annee')   ORDER BY dateFac limit $size offset $offset ";
    $requeteCountNbFact = "SELECT count(*) countF from facture where typePay  like '%$keyWord%' and  dateFac  BETWEEN '$DateActuelle' AND '$Annee'    ";
    $resultat = $pdo->query($requete);
    $data = $resultat->fetchAll();
    $resultatCountNbFact = $pdo->query($requeteCountNbFact);
    $tabCountNbFact = $resultatCountNbFact->fetch();
    $nbFactures = $tabCountNbFact['countF'];
    $nbPages = $nbFactures % $size == 0 ? $nbFactures / $size : floor($nbFactures / $size) + 1;
} else if ($Periode == "AnnPre") {
    $requete = " SELECT facture.IdF,facture.MontantTTC,facture.etat,facture.IdO,facture.dateFac,facture.typePay,objet.NomObjet,objet.IdO,client.NomClient,client.IdC from facture 
    inner join client on client.IdC=facture.IdC inner join objet on objet.IdO=facture.IdO  where (typePay  like '%$keyWord%') and (dateFac BETWEEN   '$AnneePre' AND '$DateActuelle')   ORDER BY dateFac limit $size offset $offset ";
    $requeteCountNbFact = "SELECT count(*) countF from facture where typePay  like '%$keyWord%' and  dateFac  BETWEEN   '$AnneePre' AND '$DateActuelle'    ";
    $resultat = $pdo->query($requete);
    $data = $resultat->fetchAll();
    $resultatCountNbFact = $pdo->query($requeteCountNbFact);
    $tabCountNbFact = $resultatCountNbFact->fetch();
    $nbFactures = $tabCountNbFact['countF'];
    $nbPages = $nbFactures % $size == 0 ? $nbFactures / $size : floor($nbFactures / $size) + 1;
}

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
                    <div class="panel panel-info   " style="margin-top:6%;">
                        <div class="panel-heading"><b>Gestion des Factures</b></div>
                        <div class="panel-body">
                            <form class="form-inline"> 
                                <input type="text" name="motCle" placeholder="Type payement" value="<?php echo "$keyWord" ?>">&nbsp;
                                <label for="date">Période:</label>
                                <select class="form-control" name="periode" onchange="this.form.submit()">
                                    <option value="Tous" <?php if ($Periode == "Tous") echo "selected" ?>> Toutes les périodes</option>
                                    <option value="TriCou" <?php if ($Periode == "TriCou") echo "selected" ?>>Trimestre courant</option>
                                    <option value="TriPre" <?php if ($Periode == "TriPre") echo "selected" ?>>Trimestre precedent</option>
                                    <option value="SemCou" <?php if ($Periode == "SemCou") echo "selected" ?>>Semestre courant</option>
                                    <option value="SemPre" <?php if ($Periode == "SemPre") echo "selected" ?>>Semestre precedent</option>
                                    <option value="AnnCou" <?php if ($Periode == "AnnCou") echo "selected" ?>>Année courante</option>
                                    <option value="AnnPre" <?php if ($Periode == "AnnPre") echo "selected" ?>>Année precedente</option>
                                </select>&nbsp;&nbsp; 
                                <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span> &nbsp; </button> &nbsp;
                                <a href="AjouterFacture.php"><span class="glyphicon glyphicon-plus"></span>Nouvelle facture</a>&nbsp;&nbsp;&nbsp;
                                <span>
                                    Montrer
                                    <select name="size" style="color:black;" onchange="this.form.submit()">
                                        <option value="3" <?php if ($size == 3) echo "selected" ?>>3</option>
                                        <option value="5" <?php if ($size == 5) echo "selected" ?>>5</option>
                                        <option value="10" <?php if ($size == 10) echo "selected" ?>>10</option>
                                        <option value="20" <?php if ($size == 20) echo "selected" ?>>20</option>
                                        <option value="30" <?php if ($size == 30) echo "selected" ?>>30</option>
                                        <option value="50" <?php if ($size == 50) echo "selected" ?>>50</option>
                                    </select>
                                    unité
                                </span>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="panel panel-primary ">
                        <div class="panel-heading "><b>Liste des factures (<?php echo $nbFactures; ?> factures)</b></div>
                        <div class="panel-body ">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id Facture</th>
                                        <th>Nom Client</th>
                                        <th>Date Facture</th>
                                        <th>Nom Objet</th>
                                        <th>Nbr Services </th>
                                        <th>Montant (DH)</th>
                                        <th>Etat</th>
                                        <th>Type Payement</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($data); $i++) {
                                        $idO = $data[$i]['IdO'];
                                        $idF = $data[$i]['IdF'];
                                        $Requete = $pdo->query("SELECT count(*)  CountSO from appartenance where IdO='$idO'");
                                        $count = $Requete->fetch();
                                    ?>
                                        <tr> 
                                            <td> <?php echo $data[$i]['IdF'] ?> </td>
                                            <td> <?php echo $data[$i]['NomClient'] ?> </td>
                                            <td> <?php echo $data[$i]['dateFac'] ?> </td>
                                            <td> <?php echo $data[$i]['NomObjet'] ?> </td>
                                            <td> <?php echo $count['CountSO'] ?> </td>
                                            <td> <?php echo $data[$i]['MontantTTC'] ?> </td>
                                            <td> <?php echo $data[$i]['etat'] ? '<button type="button" class="btn btn-xs btn-success"> Payée</button>' : '<button type="button" class="btn btn-xs btn-danger">Non Payée</button>' ?> </td>
                                            <td> <?php echo $data[$i]['typePay'] ?> </td>
                                            <td>
                                                <a href="ModifierFacture.php?IdF=<?php echo $data[$i]['IdF']; ?>&page=<?php echo $page; ?>&motCle=<?php echo "$keyWord"; ?>&size=<?php echo "$size"; ?>"> <span class="glyphicon glyphicon-edit"></span> </a>&nbsp;
                                                <a onclick=" return confirm(' vous confirmez la suppression ?')" href="SupprimerFacture.php?IdF=<?php echo $data[$i]['IdF']; ?>&page=<?php echo $page; ?>&motCle=<?php echo "$keyWord"; ?>&size=<?php echo "$size"; ?>">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </a>&nbsp;
                                                <a href="ImprimerFacture.php?IdF=<?php echo $data[$i]['IdF']; ?>&page=<?php echo $page; ?>&motCle=<?php echo "$keyWord"; ?>&size=<?php echo "$size"; ?>"><span class="glyphicon glyphicon-print"></span></a>&nbsp;
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <?php if ($page > 1) { ?>
                                <a href="Factures.php?page=<?php echo $page - 1; ?>&motCle=<?php echo "$keyWord"; ?>&size=<?php echo "$size"; ?>">Precedent &nbsp; </a>
                            <?php } ?>
                            <ul class="pagination pagination-sm ">
                                <?php for ($i = $page; $page <= $nbPages - 4 ? $i < $page + 4 : $i <= $nbPages; $i++) { ?>
                                    <li class=" <?php if ($i == $page) echo "active" ?>">
                                        <a href="Factures.php?page=<?php echo "$i"; ?>&motCle=<?php echo "$keyWord"; ?>&size=<?php echo "$size"; ?>"><?php echo " $i "; ?> &nbsp; &nbsp; </a>
                                    </li>
                                <?php } ?>
                                <?php if ($page < $nbPages) { ?>
                                    <a href="Factures.php?page=<?php echo $page + 1; ?>&motCle=<?php echo "$keyWord"; ?>&size=<?php echo "$size"; ?>">&nbsp; Suivant </a>
                                <?php }  ?>
                            </ul>
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