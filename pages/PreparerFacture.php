<?php 
 function fetch_data()  
 {  
      $output = '';  
      $conn = mysqli_connect("localhost", "root", "", "gestionfacture");
      $id=$_GET["IdF"];  
       $sql = "SELECT client.IdC, client.NomClient,client.Tel, client.Addresse,objet.IdO,objet.NomObjet,facture.IdF,facture.dateFac
                FROM client
                INNER JOIN facture ON client.IdC = facture.IdC INNER JOIN objet ON objet.IdO=facture.IdO
                where IdF='$id' ";
      $result = mysqli_query($conn, $sql); 
      //<strong>Date Facture : '.$row["dateFac"].'</strong> 
      while($row = mysqli_fetch_array($result))  
      {       
      $output .= '
                    
                    <div ><h4 ><strong>Facture</strong>  <strong style="margin-left:75%">'.'Date :'. date("j/n/Y"). "<br>" . '</strong></div>  
                    <br><br>
                    <div> <strong>FACTURE N° : '.$row["IdF"].'</strong></div>
                    <div>
                         
                         <strong >Nom client : '.$row["NomClient"].' </strong> 
                    </div>         
                    <div><strong>Objet : '.$row["NomObjet"].'</strong></div>
               ';  
      }
      return $output;  
 }  



 function fetch_dat()  
 {  
      $output = '';  
      $conn = mysqli_connect("localhost", "root", "", "gestionfacture");
      $id=$_GET["IdF"];  
       $sql = "SELECT service.idS,service.Designation,service.Prix,service.Qte 
               FROM service
               INNER JOIN appartenance ON appartenance.idS = service.idS INNER JOIN objet ON appartenance.idO=objet.IdO INNER JOIN facture ON facture.idO=objet.IdO  where IdF='$id'
 
                ";
       
      $result = mysqli_query($conn, $sql);  
      while($row = mysqli_fetch_array($result))  
      {       
      $output .= '
     
                    <tr class="ok"> 
                          <td >  <input type="text" name="idS" value=" '.$row["idS"].' " > </td>  
                          <td   >  <input type="text" name="Design" value=" '.$row["Designation"].' " > </td> 
                          <td  >  <input type="text" name="Prix" value=" '.$row["Prix"].' " > </td> 
                          <td  >  <input type="text" name="Qte" value=" '.$row["Qte"].' " > </td>   
                     </tr> 
                    
                     
                    

                    
                          ';  
      }    
       
      return $output.'<br><br>';  
 } 





 // -------------------------------------------------------------------------------------------
 function somme()  
 {  
      $output = '';  
      $conn = mysqli_connect("localhost", "root", "", "gestionfacture");
      $id=$_GET["IdF"];  
       $sql = "SELECT service.Qte,objet.Prix,facture.Remise,SUM(service.Prix)as somme,(objet.Prix*0.2) as Montant
               FROM service
               INNER JOIN appartenance ON appartenance.idS = service.idS INNER JOIN objet ON appartenance.idO=objet.idO INNER JOIN facture ON facture.idO=objet.idO  where IdF='$id'
                -- UNION ALL 
                
                 -- INNER JOIN appartenance ON appartenance.idS=service.idS 
                ";
       
      $result = mysqli_query($conn, $sql);  
      while($row = mysqli_fetch_array($result))  
      {       
      $output .= '
                     <table border="1" cellspacing="0" cellpadding="3" margin-Top="10px" border-color="white" align="center" width="200px">
                     <tr>
                    <th style="background-color:#42B8D8;line-height:25px;color:black;color:white;">Montant HT</th>
                       <td>'.$row["Prix"].'</td> 
                     
                     </tr>

                      <tr>
                    <th style="background-color:#42B8D8;line-height:25px;color:black;color:white;">TVA % 20</th>
                       <td>'.$row["Montant"].'</td> 
                     
                     </tr>

                      <tr>
                    <th style="background-color:#42B8D8;line-height:25px;color:black;color:white;">Remise</th>
                       <td>'.$row["Remise"].'</td> 
                     
                     </tr>
                               
                     <tr>
                    <th style="background-color:#42B8D8;line-height:25px;color:black;color:white;">Montant TTC</th>
                       <td>'.$row["Montant"].'</td> 
                     
                     </tr>
                     </table>
                  ';  
      }    
       
      return $output;  
 }  

 // ------------------------------------------------------------------------------------
 // function tva()  
 // {  
 //      $output.='
 //       <label style="border: 1px solid #ccc;"> TVA : '.$_POST['tva'].'</label><br>';
 //      return $output;  
 // }  

// -----------------------------------------------------------------------------------



 
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Preparer Facture</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />         
         
      </head>  
      <body> 
          



           <br />
           <div class="container">   
                <div class="table-responsive">  
                     <br/>
                     <br/>
                     <table class="table table-bordered">  
                          <tr> 
                               <th width="25%">Numero Service</th>  
                               <th width="25%">Designation</th>  
                               <th width="25%">Prix</th>  
                               <th width="25%">Qte</th> 
                          </tr>
                     <?php 
                         echo fetch_data(); 
                         echo fetch_dat();
                         echo somme();
                     ?> 
                     </table>  
                     <button ><a href="../Services/AjouterService.php">Ajouter service</a></button>
                     <button><a href="ImprimerFacture.php?IdF=<?php echo $_GET['IdF'];?>">Valider</a></button>
                </div>  
           </div>  
      </body>  
</html>