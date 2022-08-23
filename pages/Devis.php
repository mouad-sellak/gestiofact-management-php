<?php
    require_once("ConnexionBD.php");                                                                                
    $keyWord= isset($_GET['motCle']) ? $_GET['motCle']:"";
    $size=isset($_GET['size']) ? $_GET['size']: 3;
    $page=isset($_GET['page']) ? $_GET['page']: 1 ;
    $offset = ($page-1)*$size;
    $requete="SELECT devis.*, objet.NomObjet, objet.IdO, client.NomClient, client.IdC from devis  
    inner join client on client.IdC=devis.FK_Cli inner join objet on objet.IdO=devis.FK_Obj  where TypeA like '%$keyWord%' limit $size offset $offset ";
    $requeteCount="SELECT count(*) countD from devis where TypeA  like '%$keyWord%' ";   
    $resultat= $pdo->query($requete);
    $resultatCount= $pdo->query($requeteCount);
    $tabCount=$resultatCount->fetch();
    $nbDevis= $tabCount['countD'];
    $nbPages = $nbDevis%$size == 0 ? $nbDevis/$size : floor($nbDevis/$size)+1;
?>  
<!DOCTYPE html> 
    <head>
       <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" sizes="18x18" href="../images/G.png">
  <title>GestioFactV2</title>
  <?php include("links.php"); ?>
    </head>
    <body class="nav-md">   
         <div class="container body" >
    <div class="main_container">
      <?php include("menu.php"); ?>
     <div class="right_col" role="main" style="background-image: url(../images/home2.jpg);">
        <div class="container" >
            <div class="panel panel-info"    style="margin-top:6%;" >
                <div class="panel-heading"  ><b>Gestion des devis</b></div>
                <div class="panel-body">
                    <form class="form-inline" >
                        <input type="text" name="motCle" placeholder="Type Avance" value= "<?php echo "$keyWord" ?>"  >
                        <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span> &nbsp;Chercher </button> &nbsp; 
                        <a href="AjouterDevis.php" ><span class="glyphicon glyphicon-plus"></span>Nouveau devis</a>  
                        <b style="margin-left:300px; font-weight:normal; "> 
                                Montrer 
                                <select  name="size" style="color:black;" onchange="this.form.submit()">
                                    <option  value="3" <?php if($size==3) echo "selected"?> >3</option>
                                    <option value="5" <?php if($size==5) echo "selected"?> >5</option>
                                    <option value="10" <?php if($size==10) echo "selected"?> >10</option>  
                                </select>
                                unité
                        </b>
                    </form> 
                </div>
            </div>
        </div>
        <div class="container">
            <div class="panel panel-primary">
                <div class="panel-heading " ><b>Liste des devis (<?php echo $nbDevis; ?> Devis)</b> </div>
                <div class="panel-body "> 
                    <table class="table table-bordered" >
                        <thead>
                            <tr> <th>IdDevis</th> <th>Date</th> <th>Avance(DH)</th> <th>Type Avance</th> <th>Montant HT (DH)</th>  <th>Nom Objet</th> <th>Nom Client</th> <th>Actions</th> </tr>                             `                           
                        </thead>
                        <tbody>                       
                            <?php   while($devis = $resultat->fetch()) { ?>
                            <tr>    
                                <td> <?php echo $devis['IdD'] ?> </td>
                                <td> <?php echo $devis['DateD'] ?> </td>
                                <td> <?php echo $devis['Avance'] ?> </td>
                                <td> <?php echo $devis['TypeA'] ?> </td>
                                <td> <?php echo $devis['MontantHT'] ?> </td>
                                <td> <?php echo $devis['NomObjet']   ?> </td> 
                                <td> <?php echo $devis['NomClient'] ?> </td> 
                                <td>
                                    <a href="ModifierDevis.php?IdD=<?php echo $devis['IdD']; ?>&typeA=<?php echo $devis['TypeA'];?>&NomObj=<?php echo $devis['IdO'];?>&NomCli=<?php echo $devis['IdC'];?>" > <span class="glyphicon glyphicon-edit"></span> </a> &nbsp;
                                    <a onclick=" return confirm(' vous confirmez la suppression ?')" href="SupprimerDevis.php?IdD=<?php echo $devis['IdD']; ?>"><span class="glyphicon glyphicon-trash"></span></a>&nbsp; 
                                    <a href="ImprimerDevis.php?IdD=<?php echo $devis['IdD']; ?>&page=<?php echo $page; ?>&motCle=<?php echo "$keyWord"; ?>&size=<?php echo "$size"; ?>" ><span class="glyphicon glyphicon-print"></span></a> &nbsp;
                                   
                                </td>                   
                            </tr>                                                                                                          
                            <?php } ?>                
                        </tbody>           
                    </table>
                    <?php  if($page>1) { ?>
                        <a  href="Devis.php?page=<?php echo $page-1 ;?>&motCle=<?php echo "$keyWord" ; ?>&size=<?php echo "$size" ; ?>" >Precedent &nbsp; </a>               
                    <?php } ?>
                    <ul class="pagination pagination-sm">
                    <?php for($i=$page; $page<=$nbPages-4 ? $i<$page+4 : $i<=$nbPages ; $i++) { ?>
                        <li class=" <?php if($i==$page) echo "active" ?>" >
                              <a href="Devis.php?page=<?php echo "$i";?>&motCle=<?php echo "$keyWord" ; ?>&size=<?php echo "$size" ; ?>" ><?php echo " $i " ; ?>  &nbsp; &nbsp; </a>                                                                                              
                        </li> 
                    <?php } ?> 
                    <?php if($page < $nbPages){ ?>
                        <a href="Devis.php?page=<?php echo $page+1;?>&motCle=<?php echo "$keyWord" ; ?>&size=<?php echo "$size" ; ?>" >&nbsp;  Suivant   </a>
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