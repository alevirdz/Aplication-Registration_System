<?php 
require '../config/database.php';
require 'validations.php';
/*
Este archivo contiene las siguientes opciones:
Consultas, Insertar, Eliminar, Resetear
*/

//Consulta en la base de datos
if( isset($_POST['generateTable_']) )
{
    $stmt = $BD->prepare("SELECT * FROM donaciones");
    $stmt->execute();
    $userData = array();
    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
      $userData['ALL'][] = $row;}
    echo json_encode($userData);      
}

// Inserta en la base de datos
if( 
    isset ($_POST['insertDonations']) && 
    isset($_POST['nombre']) && 
    isset($_POST['donacion']) 
){
     //Verificacion
     if( 
         !empty($_POST['insertDonations']) && 
         !empty($_POST['nombre']) && 
         !empty($_POST['donacion']) 
    ){
        $userName       = trim($_POST['nombre']);
        $userDonation   = trim($_POST['donacion']);

        $cleanDonation  = preg_replace('/[$#!¡?¿"%&=\-*\/@+ (\) a-z A-Z ]/', '', $userDonation);
        $checkedMoneda  = checkedMoneda($cleanDonation);
        $checkedName    = checkedText($userName);

            if($checkedName === true){
            $stmt = $BD->prepare("INSERT INTO donaciones (nombre, donacion) VALUES (?, ?)");
            $stmt->bindParam(1, $userName);
            $stmt->bindParam(2, $cleanDonation);
            $stmt->execute();
            echo "true";
            }
            else{
            echo "false";
            }
    }else{
        echo "empty_fields";
    }
}


//Eliminar en la base de datos
if( 
    isset($_POST['deleteDonations']) && 
    !empty($_POST['deleteDonations']) 
){
    $userId = trim($_POST['deleteDonations']);
    $stmt   = $BD->prepare("DELETE FROM donaciones WHERE id=$userId ");
    $stmt->execute();
    echo "true";
}

//Resetear toda la tabla
if(isset($_POST["deleteDonationsAll"]) ){
    $stmt = $BD->prepare("DELETE FROM donaciones");
    $stmt->execute();
    echo "true";
}