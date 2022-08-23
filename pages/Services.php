<?php
    require_once("ConnexionBD.php");              
    $keyWord= isset($_GET['motCle']) ? $_GET['motCle']:"";
    $size=isset($_GET['size']) ? $_GET['size']: 3 ;
    $page=isset($_GET['page']) ? $_GET['page']: 1 ;
    $offset = ($page-1)*$size;
    $requete="SELECT * from service  where Designation  like '%$keyWord%' limit $size offset $offset ";
    $requeteCount="SELECT count(*) countS from service where Designation like '%$keyWord%'  ";   
    $resultat= $pdo->query($requete);
    $resultatCount= $pdo->query($requeteCount);
    $tabCount=$resultatCount->fetch();
    $nbServices= $tabCount['countS'];
    $nbPages = $nbServices%$size == 0 ? $nbServices/$size : floor($nbServices/$size)+1;
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
          <div class="container body" >
    <div class="main_container">
      <?php include("menu.php"); ?>
      <div class="right_col" role="main" style="background-image: url(../images/home2.jpg);">
        <div class="container" >
            <div class="panel panel-info   "  style="margin-top: 6%;">
                <div class="panel-heading"><b>Gestion des Services</b></div>
                <div class="panel-body">
                    <form class="form-inline" >
                        <input type="text" name="motCle" placeholder="Nom service"  >
                        <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span> &nbsp;Chercher </button>  &nbsp;
                        <a href="AjouterService.php" ><span class="glyphicon glyphicon-plus"></span>Nouveau Service</a> 
                        &nbsp; 
                        <b style="flex:right; font-weight:normal; "> 
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
            <div class="panel panel-primary  ">
                <div class="panel-heading " >Liste des services (<?php echo $nbServices; ?> services) </div>
                <div class="panel-body PosiPanel "> 
                    <table class="table table-bordered" >
                        <thead>
                            <tr> <th>Id Service</th> <th>Designation</th> <th>Prix(DH)</th>  <th>Actions</th> </tr>                             `                           
                        </thead>
                        <tbody>                       
                            <?php    
                                while($data = $resultat->fetch()) { 
                                ?> 
                                    <tr>    <!--  fetch -> retourne un tableau associatif -->
                                        <td> <?php echo $data['idS'] ?> </td>
                                        <td> <?php echo $data['Designation'] ?> </td>
                                         <td> <?php echo $data['Prix'] ?> </td> 
                                        <td>
                                            <a href="ModifierService.php?idS=<?php echo $data['idS']; ?>&page=<?php echo $page ; ?>&motCle=<?php echo "$keyWord"; ?>&size=<?php echo "$size"; ?>"> <span class="glyphicon glyphicon-edit"></span> </a>&nbsp;
                                            <a onclick=" return confirm(' vous confirmez la suppression ?')" 
                                                href="SupprimerService.php?idS=<?php echo $data['idS']; ?>&page=<?php echo $page ; ?>&motCle=<?php echo "$keyWord"; ?>&size=<?php echo "$size"; ?>"> 
                                                <span class="glyphicon glyphicon-trash"></span> 
                                            </a>
                                        </td>
                                    </tr>
                                <?php   }  ?>                
                        </tbody>          
                    </table> 
                    <?php  if($page>1) { ?>
                        <a  href="Services.php?page=<?php echo $page-1 ;?>&motCle=<?php echo "$keyWord" ; ?>&size=<?php echo "$size" ; ?>" >Precedent &nbsp; </a>               
                    <?php } ?>
                    <ul class="pagination pagination-sm ">
                        <?php for($i=$page; $page<=$nbPages-4 ? $i<$page+4 : $i<=$nbPages ; $i++) { ?>
                            <li class=" <?php if($i==$page) echo "active" ?>" >
                                <a href="Services.php?page=<?php echo "$i";?>&motCle=<?php echo "$keyWord" ; ?>&size=<?php echo "$size" ; ?>" ><?php echo " $i " ; ?>  &nbsp; &nbsp; </a>                                                                                              
                            </li> 
                        <?php } ?>
                        <?php if($page < $nbPages){ ?>
                        <a href="Services.php?page=<?php echo $page+1;?>&motCle=<?php echo "$keyWord" ; ?>&size=<?php echo "$size" ; ?>" >&nbsp;  Suivant   </a>
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