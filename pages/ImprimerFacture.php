<?php
function head_bill()
{
     $output = '';
     $conn = mysqli_connect("localhost", "root", "", "gestion_factures");
     $id = $_GET["IdF"];
     $sql = "SELECT client.IdC, client.NomClient,client.Tel, client.Addresse,objet.IdO,objet.NomObjet,facture.IdF,facture.dateFac
                FROM client
                INNER JOIN facture ON client.IdC = facture.IdC INNER JOIN objet ON objet.IdO=facture.IdO
                where IdF='$id'
                ";
     $result = mysqli_query($conn, $sql);
     while ($row = mysqli_fetch_array($result)) {
          $output .= '
                       <div></div>
                       <div></div>
                       <div></div>
                       <div></div>
                       <div></div>
                       <div>  
                          <label style="font-weight:bold;">FACTURE N° : ' . $row["IdF"] . '</label>  
                      </div>
                      <div>
                         <label style="font-weight:bold;">Date Facture : ' . $row["dateFac"] . '</label>  
                      </div>
                      <div>
                      <label style="font-weight:bold;">Client : ' . $row["NomClient"] . '</label>  
                      </div>
                      <div>
                            <label style="font-weight:bold;">Objet : ' . $row["NomObjet"] . '</label><br><br><br>
                      </div>         
                          ';
     }
     return $output;
}
function main_bill()
{
     $output = '';
     $conn = mysqli_connect("localhost", "root", "", "gestion_factures");
     $id = $_GET["IdF"];
     $sql = "SELECT service.idS,service.Designation,service.Prix,appartenance.Qte
               FROM service
               INNER JOIN appartenance ON appartenance.IdS = service.idS INNER JOIN objet ON appartenance.IdO=objet.IdO INNER JOIN facture ON facture.IdO=objet.IdO  where IdF='$id'
                ";
     $result = mysqli_query($conn, $sql);
     $i = 1;
     while ($row = mysqli_fetch_array($result)) {
          $output .= '
     
                     <tr style="line-height:20px;"   border="2"> 
                          <td >' . $i . '</td>  
                          <td >' . $row["Designation"] . '</td>  
                          <td >' . $row["Prix"] . '</td>  
                          <td >' . $row["Qte"] . '</td>  
                     </tr>  
                          ';
          $i++;
     }
     return $output;
}
function cost()
{
     $output = '';
     $conn = mysqli_connect("localhost", "root", "", "gestion_factures");
     $id = $_GET["IdF"];
     $sql = "SELECT facture.IdF,facture.Remise,SUM(service.Prix*appartenance.Qte) as MHT FROM service
               INNER JOIN appartenance ON appartenance.IdS = service.idS INNER JOIN objet ON appartenance.IdO=objet.IdO INNER JOIN facture ON facture.IdO=objet.IdO  where IdF='$id'
      ";
     $result = mysqli_query($conn, $sql);
     while ($row = mysqli_fetch_array($result)) {
          $MHT = $row["MHT"];
          $TVA = $MHT*0.2;
          $Remise = ($MHT+$TVA)*$row["Remise"]/100 ;
          $MTTC = $MHT+$TVA-$Remise;
          $output .= '  <div>
                     <div>
                     <table border="1"  align="center" style="margin-right:auto" border-color="white" align="center" width="200px">
                     <tr style="line-height:25px">
                    <th style="background-color:#42B8D8;color:black;color:white;">Montant HT</th>
                       <td>' . $MHT . ' DH </td>  
                     </tr>

                      <tr style="line-height:25px">
                    <th style="background-color:#42B8D8;line-height:25px;color:black;color:white;">TVA % 20</th>
                       <td>' . $TVA . ' DH </td> 
                     
                     </tr> 

                      <tr style="line-height:25px">
                    <th style="background-color:#42B8D8;line-height:25px;color:black;color:white;">Remise % '.$row["Remise"].'</th>
                       <td>' . $Remise . ' DH </td> 
                     
                     </tr>
                               
                     <tr style="line-height:25px">
                    <th style="background-color:#42B8D8;line-height:25px;color:black;color:white;">Montant TTC</th>
                       <td>' . $MTTC . ' DH </td> 
                     
                     </tr>
                     </table>
                       </div>
                       </div>
                  ';
          $sql1 = " UPDATE facture set MontantHT='$MHT',TVA='$TVA',MontantTTC='$MTTC'  where IdF='$id'  ";
          $res = mysqli_query($conn, $sql1);
          return $output;
     }
}
if (isset($_POST["generate_pdf"])) {
     require_once('tcpdf/tcpdf.php');
     $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
     $obj_pdf->SetCreator(PDF_CREATOR);
     $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
     $obj_pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
     $obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
     $obj_pdf->SetDefaultMonospacedFont('helvetica');
     $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
     $obj_pdf->SetMargins(35, 12, true);
     $obj_pdf->setPrintHeader(false);
     $obj_pdf->setPrintFooter(false);
     $obj_pdf->SetAutoPageBreak(false, 0);
     $obj_pdf->SetFont('helvetica', '', 10);
     $obj_pdf->AddPage();
     $obj_pdf->SetLineStyle(array('width' => 6, 'color' => array(0, 0, 0)));
     $img_file = K_PATH_IMAGES . 'FactBack.jpg';
     $obj_pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
     $obj_pdf->setPageMark();
     $content = '';
     $content .= head_bill();
     $content .= '
     <table style="width: 100%;" border="1" margin-left="10px" border-color="black" align="center" width="400px">

                <tr style="background-color:#42B8D8;line-height:25px;color:black;color:white;">  
                <th>Numero Service</th>  
                <th>Designation</th>  
                <th>Prix</th>  
                <th>Qte</th>  
               </tr>
      ';
     $content .= main_bill();
     $content .= cost();
     $content .= '</table>';
     $obj_pdf->writeHTML($content);
     ob_end_clean();
     $obj_pdf->Output('file.pdf', 'I');
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
               <div class="right_col" role="main" style="background-image: url(../images/FactBack.jpg);">
                    <div class="container">
                         <div align="right">
                              <form method="post">
                                   <input type="submit" name="generate_pdf" class="btn btn-info" value="Imprimer" />
                                   <button type="submit" class="btn btn-info">
                                        <a href="Factures.php?IdF=<?php echo $_GET['IdF']; ?>&page=<?php echo $_GET['page']; ?>&motCle=<?php echo $_GET['motCle']; ?>&size=<?php echo $_GET['size']; ?>" style="color:white;">&nbsp;Retour</a>
                                   </button>
                              </form>
                         </div>
                         <div>
                              <table class="table " border="2" border-color="blue">
                                   <tr border="2">
                                        <th width="25%">Numero Service</th>
                                        <th width="25%">Designation</th>
                                        <th width="25%">Prix</th>
                                        <th width="25%">Qte</th>
                                   </tr>
                                   <b><?php
                                   echo head_bill();
                                   echo main_bill();
                                   echo cost();
                                   ?></b>
                              </table>
                              <br>
                         </div>
                    </div>
               </div>
               <?php include("footer.php"); ?>
          </div>
     </div>
     <?php include("script.php"); ?>
</body>

</html>