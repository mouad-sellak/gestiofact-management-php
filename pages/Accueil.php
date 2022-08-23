<?php
require_once("ConnexionBD.php");
$requeteClients = $pdo->query("SELECT count(*) as countC from client ");
$requeteUtilisateurs = $pdo->query("SELECT count(*) as countU from utilisateur ");
$requeteObjets = $pdo->query("SELECT count(*) as countO from objet ");
$requeteServices = $pdo->query("SELECT count(*) as countS from service ");
$requeteDevis = $pdo->query("SELECT count(*) as countD from devis ");
$requeteFactures = $pdo->query("SELECT count(*) as countF from facture ");

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" sizes="18x18" href="../images/G.png">
	<title>GestioFact</title>
	<?php include("links.php"); ?>
</head>
<style>
	b{
		color:cornflowerblue;
	}
</style>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<?php include("menu.php"); ?>
			<div class="right_col" role="main"  style="background-image: url(../images/FactBack.jpg);">
				<div class="row tile_count">
					<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
						<b>T Utilisateurs</b>
						<img src="../images/utilisateur.png" alt="client" with="65px" height="65px" style="float:left;">
						<div class="count">&nbsp;&nbsp;<?php echo $requeteUtilisateurs->fetch()['countU']; ?></div>&nbsp;
						<a href="Utilisateurs.php"  ><b style="margin-left:85px" >Détails</b></a>
					</div>
					<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
						<b>Total Clients</b>
						<img src="../images/client.png" alt="client" with="65px" height="65px" style="float:left;">
						<div class="count">&nbsp;&nbsp;<?php echo $requeteClients->fetch()['countC']; ?></div>&nbsp;
						<a href="Clients.php" ><b style="margin-left:85px" >Détails</b></a>
					</div>
					<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
						<b>Total Objets</b>
						<img src="../images/objet.png" alt="client" with="65px" height="65px" style="float:left;">
						<div class="count">&nbsp;&nbsp;<?php echo $requeteObjets->fetch()['countO']; ?></div>&nbsp;
						<a href="Objets.php" ><b style="margin-left:85px" >Détails</b></a>
					</div>
					<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
						<b>Total Services</b>
						<img src="../images/service.png" alt="client" with="65px" height="65px" style="float:left;">
						<div class="count">&nbsp;&nbsp;<?php echo $requeteServices->fetch()['countS']; ?></div>&nbsp;
						<a href="Services.php"   ><b style="margin-left:85px" >Détails</b></a>
					</div>
					<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
						<b>Total Devis</b>
						<img src="../images/devis.png" alt="client" with="65px" height="65px" style="float:left;">
						<div class="count">&nbsp;&nbsp;<?php echo $requeteDevis->fetch()['countD']; ?></div>&nbsp;
						<a href="Devis.php" ><b style="margin-left:85px" >Détails</b></a>
					</div>
					<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
						<b>Total Factures</b>
						<img src="../images/facture.png" alt="client" with="65px" height="65px" style="float:left;">
						<div class="count">&nbsp;&nbsp;<?php echo $requeteFactures->fetch()['countF']; ?></div>&nbsp;
						<a href="Factures.php"  ><b style="margin-left:75px" >Détails</b></a>
					</div>
					<img src="../images/logo.png" width="600px" height="130px" style="margin: 12%;  " >
				</div>
			</div>
			<?php include("footer.php"); ?>
		</div>
	</div>
	<?php include("script.php"); ?>
</body>

</html>