<?php 

$conn = new mysqli("localhost","root","","gestion_factures");

$name  = $_POST['name'];
$email = $_POST['email'];
$Qte = $_POST['Qte'];

$sql   = "INSERT INTO appartenance (IdS,IdO,Qte) VALUES ('$name', '$email','$Qte')";

$conn->query($sql);
 
$post_data = $_POST;
$id['IdS'] = $conn->insert_id;

$data = array_merge($id,$post_data);
echo json_encode($data);