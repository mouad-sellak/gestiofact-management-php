  <?php
    require_once("ConnexionBD.php");
    $id = $_GET['IdD'];
    $requeteID = " SELECT * FROM devis WHERE IdD=$id ";
    $resultat = $pdo->query($requeteID);
    $data = $resultat->fetch();
    if (isset($_POST['update'])) {
        $date = htmlspecialchars($_POST['date']);
        $avance = htmlspecialchars($_POST['Avance']);
        $typeA = htmlspecialchars($_POST['typeAvan']);
        echo $typeA;
        $IdO = htmlspecialchars($_POST['NomObj']);
        $IdC = htmlspecialchars($_POST['NomCli']);
        $requeteUpdate = "UPDATE devis SET DateD='$date',Avance='$avance',TypeA='$typeA', FK_Cli='$IdC', FK_Obj='$IdO' WHERE IdD='$id' ";
        $resultatUpdate = $pdo->query($requeteUpdate);
        $alert = "<div class='alert alert-success'><b>Le devis  est modifé avec succès !</b></div>";
        header("refresh:0.5;url=Devis.php");
    }
    ?>

  <!DOCTYPE html>
  <html>

  <head>
      <meta charset="utf-8">
      <title>Modifier devis</title>
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
                      <div class="panel panel-info   " style="margin-top: 6%;">
                          <div class="panel-heading ">
                              <h5>Modifier devis</h5>
                          </div>
                          <div class="panel-body">
                            <?php if (isset($_POST['update'])) echo $alert; ?>
                              <form method="POST">
                                  <div class="form-group">
                                      <label class="form-label">Date</label>
                                      <input type="date" class="form-control" name="date" value="<?php echo $data['DateD'] ?>" required>
                                  </div>
                                  <div class="form-group">
                                      <label class="form-label">Avance(DH)</label>
                                      <input type="number" class="form-control" name="Avance" value="<?php echo $data['Avance'] ?>" required>
                                  </div>
                                  <div class="form-group">
                                      <label class="form-label">Type Avance</label>
                                      <select class="form-control" name="typeAvan">
                                          <option value="Espèce" <?php if ($_GET['typeA'] == "Espèce") echo "selected" ?>>Espèce</option>
                                          <option value="Virement" <?php if ($_GET['typeA'] == "Virement") echo "selected" ?>>Virement</option>
                                          <option value="Cache" <?php if ($_GET['typeA'] == "Cache") echo "selected" ?>>Cache</option>
                                          <option value="Transfert" <?php if ($_GET['typeA'] == "Transfert") echo "selected" ?>>Transfert</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label> Nom Objet: </label>
                                      <select class="form-control" name="NomObj">
                                          <?php
                                            require_once("ConnexionBD.php");
                                            $ReqNomObj = "SELECT objet.NomObjet,objet.IdO from objet ";
                                            $ResultatObj = $pdo->query($ReqNomObj);
                                            ?>
                                          <?php while ($obj = $ResultatObj->fetch()) { ?>
                                              <option value="<?php echo $obj['IdO'] ?>" <?php if ($_GET['NomObj'] == $obj['IdO']) echo "selected" ?>> <?php echo $obj['NomObjet'] ?> </option>
                                          <?php } ?>
                                      </select>
                                  </div>

                                  <div class="form-group">
                                      <label>Nom Client:</label>
                                      <select class="form-control" name="NomCli">
                                          <?php
                                            require_once("ConnexionBD.php");
                                            $ReqNomCli = "SELECT client.NomClient,client.IdC from client ";
                                            $ResultatCli = $pdo->query($ReqNomCli);
                                            ?>
                                          <?php while ($cli = $ResultatCli->fetch()) { ?>
                                              <option value="<?php echo $cli['IdC'] ?>" <?php if ($_GET['NomCli'] == $cli['IdC']) echo "selected" ?>> <?php echo $cli['NomClient'] ?> </option>
                                          <?php } ?>
                                      </select>
                                  </div>
                                  <input type="submit" id="add" class="btn btn-info" name="update" value="Modifier Devis">
                                  <span>
                                      <a href="Devis.php"><b>&nbsp;Retour</b></a>
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