<?php
require_once("ConnexionBD.php");
$id = $_GET['IdF']; 
$requeteSelect = "SELECT * from facture where IdF='$id'"; 
$resultatSelect = $pdo->query($requeteSelect);
$data = $resultatSelect->fetch();
if (isset($_POST['update'])) {
  $date = htmlspecialchars($_POST['date']);
  $remise = htmlspecialchars($_POST['remise']);
  $typePay = htmlspecialchars($_POST['typePay']);
  $IdC = htmlspecialchars($_POST['IdC']);
  $IdO = htmlspecialchars($_POST['IdO']);
  $etat = htmlspecialchars($_POST['etat']);
  $insertionClient = $pdo->prepare("UPDATE facture SET IdC=?,IdO=?,dateFac=?,Remise=?,typePay=?,etat=? where IdF='$id'"  );
  $insertionClient->execute(array($IdC, $IdO, $date, $remise, $typePay,$etat));
  $alert = "<div class='alert alert-success'><b>La facture  est modifée avec succès !</b></div>";
  header("refresh:0.5;url=Factures.php");
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" sizes="18x18" href="../images/G.png">
  <title>GestioFact</title>
  <?php include("links.php"); ?>
  <style type="text/css">
    table {
      margin: 18px 0;
      width: 100%;
      border-collapse: collapse;
    }

    table th,
    table td {
      text-align: left;
      padding: 6px;
    }

    table,
    th,
    td {
      border: 1px solid #000;
    }
  </style>
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <?php include("menu.php"); ?>
      <div class="right_col" role="main" style="background-image: url(../images/home2.jpg);">
        <div class="container">
          <div class="panel panel-info" style="margin-top:60px;">
            <div class="panel-heading ">
              <h5>Modifier Facture</h5>
            </div>
            <div class="panel-body">
              <?php if (isset($_POST['update'])) echo $alert; ?>
              <form method="POST"  id="fact">
              <div class="form-group">
                  <label class="form-label">Nom Objet</label>
                  <select class="form-control" name="IdO" id="IdO">
                    <?php
                    require_once("ConnexionBD.php");
                    $ReqNomCli = "SELECT objet.NomObjet,objet.IdO from objet";
                    $ResultatCli = $pdo->query($ReqNomCli);
                    ?>
                    <?php while ($cli = $ResultatCli->fetch()) { ?>
                      <option <?php if ($data['IdO'] == $cli['IdO']) echo "selected" ?> value="<?php echo $cli['IdO'] ?>"> <?php echo $cli['NomObjet'] ?> </option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label class="form-label">Nom Client</label>
                  <select class="form-control" name="IdC">
                    <?php
                    require_once("ConnexionBD.php");
                    $ReqNomCli = "SELECT client.NomClient,client.IdC from client";
                    $ResultatCli = $pdo->query($ReqNomCli);
                    ?>
                    <?php while ($cli = $ResultatCli->fetch()) { ?>
                      <option <?php if ($data['IdC'] == $cli['IdC']) echo "selected" ?> value="<?php echo $cli['IdC'] ?>"> <?php echo $cli['NomClient'] ?> </option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label class="form-label">Date</label>
                  <input value="<?php echo $data['dateFac'] ?>" type="date" class="form-control" name="date">
                </div>
                <div class="form-group">
                  <label class="form-label">Type Payement</label>
                  <select class="form-control" name="typePay">
                    <option <?php if ($data['typePay'] == "Espèce") echo "selected" ?> value="Espèce">Espèce</option>
                    <option <?php if ($data['typePay'] == "Virement") echo "selected" ?> value="Virement">Virement</option>
                    <option <?php if ($data['typePay'] == "Cache") echo "selected" ?> value="Cache">Cache</option>
                    <option <?php if ($data['typePay'] == "Transfert") echo "selected" ?> value="Transfert">Transfert</option>
                  </select>  
                </div>
                <div class="form-group">
                  <label class="form-label">Remise</label>
                  <input value="<?php echo $data['Remise'] ?>" type="number" class="form-control" name="remise">
                </div>
                <div class="form-group">
                  <label class="form-label">Etat</label>
                  <select class="form-control" name="etat">
                    <option <?php  echo $data['etat']? "selected":"" ?> value=1>Payée</option>
                    <option <?php echo !$data['etat']? "selected":"" ?> value=0>Non Payée</option>
                  </select>
                </div>
                <input type="submit" id="add" class="btn btn-info" name="update" value="Modifier Facture">
                <span>
                  <a href="Factures.php"><b>&nbsp;Retour</b></a>
                </span>
              </form>
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