<?php
require_once("ConnexionBD.php");
$login = isset($_GET['login']) ? $_GET['login'] : "";
$size = isset($_GET['size']) ? $_GET['size'] : 4;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;
$requeteUser = "select * from utilisateur where login like '%$login%'";
$requeteCount = "select count(*) countUser from utilisateur where login like '%$login%' ";
$resultatUser = $pdo->query($requeteUser);
$resultatCount = $pdo->query($requeteCount);
$tabCount = $resultatCount->fetch();
$nbrUser = $tabCount['countUser'];
$reste = $nbrUser % $size;
if ($reste === 0)
    $nbrPage = $nbrUser / $size;
else
    $nbrPage = floor($nbrUser / $size) + 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
        <div class="container" >
          <div class="panel panel-info  " style="margin-top:6%">
              <div class="panel-heading"> <b>Gestion des utilisateurs</b> </div>
              <div class="panel-body">
                  <form method="get" action="Utilisateurs.php" class="form-inline">
                      <div class="form-group">
                          <input type="text" name="login" placeholder=" Chercher par login" class="form-control" value="<?php echo $login ?>" />
                      </div>
                      <button type="submit" class="btn btn-info">
                          <span class="glyphicon glyphicon-search"></span>
                      </button> &nbsp;&nbsp;
                      <span style="color:cornflowerblue; ">
                          Montrer
                          <select name="size" style="color:black;" onchange="this.form.submit()">
                              <option value="4" <?php if ($size == 4) echo "selected" ?>>4</option>
                              <option value="8" <?php if ($size == 8) echo "selected" ?>>8</option>
                              <option value="16" <?php if ($size == 16) echo "selected" ?>>16</option>
                              <option value="25" <?php if ($size == 25) echo "selected" ?>>25</option>
                          </select>
                          unité
                      </span>
                  </form>
              </div>
          </div>

          <div class="panel panel-primary " style="text-align: center;">
              <div class="panel-heading"><b>Liste des utilisateurs (<?php echo $nbrUser ?> utilisateurs)</b></div>
              <div class="panel-body">
                  <table class="table table-striped table-bordered">
                      <thead>
                          <tr>
                              <th>login</th>
                              <th>Email</th>
                              <th>Role</th>
                              <th>Actions</th>
                          </tr>
                      </thead>

                      <tbody>
                          <?php while ($user = $resultatUser->fetch()) { ?>
                              <tr class="<?php echo $user['etat'] == 1 ? 'info' : 'danger' ?>" >
                                  <td><?php echo $user['login'] ?> </td>
                                  <td><?php echo $user['email'] ?> </td>
                                  <td><?php echo $user['role'] ?> </td>
                                  <td>
                                    
                                      &nbsp;&nbsp;
                                      <a title="Supprimer utilisateur" onclick="return confirm('Etes vous sur de vouloir supprimer cet utilisateur')" href="SupprimerUtilisateur.php?idUser=<?php echo $user['id'] ?>">
                                          <span class="glyphicon glyphicon-trash"></span>
                                      </a>
                                      &nbsp;&nbsp;
                                      <a title="Activer utilisateur" href="ActiverUtilisateur.php?id=<?php echo $user['id'] ?>&etat=<?php echo $user['etat']  ?>">
                                          <?php
                                          if ($user['etat'] == 1)
                                              echo '<span class="glyphicon glyphicon-remove"></span>';
                                          else
                                              echo '<span class="glyphicon glyphicon-ok"></span>';
                                          ?>
                                      </a>
                                  </td>
                              </tr>
                          <?php } ?>
                      </tbody>
                  </table>
                <div>
                      <ul class="pagination">
                          <?php for ($i = 1; $i <= $nbrPage; $i++) { ?>
                              <li class="<?php if ($i == $page) echo 'active' ?>">
                                  <a href="utilisateurs.php?page=<?php echo $i; ?>&login=<?php echo $login ?>">
                                      <?php echo $i; ?>
                                  </a>
                              </li>
                          <?php } ?>
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
