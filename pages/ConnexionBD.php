<?php

try{
     $pdo= new PDO("mysql:host=localhost;dbname=gestion_factures","root","");

    }
    catch(Exception $e){
         die('Ereur de connection' . $e  );
    }    
