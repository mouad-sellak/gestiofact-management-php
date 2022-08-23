<?php
require_once("ConnexionBD.php");
if (isset($_POST['service'])) {
    if (!empty($_POST['date']) && !empty($_POST['avance']) && !empty($_POST['typeAvan']) && !empty($_POST['IdC']) && !empty($_POST['IdO'])) {
        $date = htmlspecialchars($_POST['date']);
        $avance = htmlspecialchars($_POST['avance']);
        $typeAvan = htmlspecialchars($_POST['typeAvan']);
        $IdC = htmlspecialchars($_POST['IdC']);
        $IdO = htmlspecialchars($_POST['IdO']);
        $MHT=0;
        $insertionClient = $pdo->prepare('INSERT INTO devis(DateD,Avance,TypeA,MontantHT,FK_Obj,FK_Cli) VALUES(?,?,?,?,?,?)');
        $insertionClient->execute(array($date, $avance, $typeAvan,$MHT,$IdO, $IdC));
        $alert = "<div class='alert alert-success'><b>Le devis  est ajouté avec succès !</b></div>";
        header("refresh:0.5;url=Devis.php");
    }
} 

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="18x18" href="../images/G.png">
    <title>GestioFactV2</title>
    <?php include("links.php"); ?>
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <?php include("menu.php"); ?>
            <div class="right_col" role="main" style="background-image: url(../images/home2.jpg);">
                <div class="container">
                    <div class="panel panel-info " style="margin-top: 6%;">
                        <div class="panel-heading ">
                            <h5>Ajouter Devis</h5>
                        </div>
                        <div class="panel-body">
                            <?php if (isset($_POST['service'])) echo $alert; ?>
                            <form method="POST" action="AjouterDevis.php" id="fact">
                                <div class="form-group">
                                    <label class="form-label">Date</label>
                                    <input type="date" class="form-control" name="date">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Avance</label>
                                    <input type="number" class="form-control" name="avance">
                                </div>
                                <div class="form-group">
                                    <label class="form-label"> Type Avance </label>
                                    <select class="form-control" name="typeAvan">
                                        <option value="Espèce">Espèce</option>
                                        <option value="Virement">Virement</option>
                                        <option value="Cache">Cache</option>
                                        <option value="Transfert">Transfert</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Client</label>
                                    <select class="form-control" name="IdC">
                                        <?php
                                        require_once("ConnexionBD.php");
                                        $ReqNomCli = "SELECT client.NomClient,client.IdC from client";
                                        $ResultatCli = $pdo->query($ReqNomCli);
                                        ?>
                                        <?php while ($cli = $ResultatCli->fetch()) { ?>
                                            <option value="<?php echo $cli['IdC'] ?>"> <?php echo $cli['NomClient'] ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <input type="submit" id="add" class="btn btn-info" name="service" value="Ajouter Devis">
                                <span>
                                    <a href="Devis.php"><b>&nbsp;Retour</b></a>
                                </span>
                            </form>
                            <form id="service" method="POST">
                                <div class="form-group">
                                    <label class="form-label">Objet</label>
                                    <select class="form-control" name="email" id="IdO">
                                        <?php
                                        require_once("ConnexionBD.php");
                                        $ReqNomCli = "SELECT objet.NomObjet,objet.IdO from objet";
                                        $ResultatCli = $pdo->query($ReqNomCli);
                                        ?>
                                        <?php while ($cli = $ResultatCli->fetch()) { ?>
                                            <option value="<?php echo $cli['IdO'] ?>"> <?php echo $cli['NomObjet'] ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Service</label>
                                    <select class="form-control" name="name" id="service">
                                        <?php
                                        require_once("ConnexionBD.php");
                                        $ReqNomCli = "SELECT service.Designation,service.IdS from service";
                                        $ResultatCli = $pdo->query($ReqNomCli);
                                        ?>
                                        <?php while ($cli = $ResultatCli->fetch()) { ?>
                                            <option value="<?php echo $cli['IdS'] ?>"> <?php echo $cli['Designation'] ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Quantité de services :</label>
                                    <input type="number" class="form-control" name="Qte" id="Qte" required>
                                </div>
                                <button type="submit" class="btn btn-info">Inserer Service Objet</button>
                                <table class="table-bordered table ">
                                    <thead>
                                        <tr>
                                            <th>Service</th>
                                            <th>Objet</th>
                                            <th>Qte</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr> </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php include("footer.php"); ?>
        </div>
    </div>
    <?php include("script.php"); ?>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $("#service").on("submit", function(e) {
                e.preventDefault();
                var id = $("#IdO").val();
                var tva = $("#Qte").val();
                $.ajax({
                    url: "InsererServiceObjet.php",
                    method: "POST",
                    data: $("form").serializeArray(),
                    dataType: "json",
                    beforeSend: function() {
                        $('.loader').show();
                    },
                    success: function(data) {
                        $txt = '<tr><td>' + data.name + '</td><td>' + data.email + '</td><td>' + data.Qte + '</td></tr>';
                        $('tbody').prepend($txt);
                        $('.loader').hide();
                        $("#fact").append("<input type='hidden' value='" + id + "' name='IdO'>");
                        $("#fact").append("<input type='hidden' value='" + tva + "' name='Qte'>");
                    }
                });
            });
        });
    </script>
</body>

</html>