<?php 
require '../config/database.php';
require 'validations.php';
/*
Este archivo contiene las siguientes opciones:
Consultas, Insertar, Editar, Actualizar, Eliminar, Resetear
*/

//Consulta en la base de datos
if( isset($_POST['showRegister']) ){
    $stmt = $BD->prepare("SELECT * FROM inscripciones");
    $stmt->execute();
    $userData = array();

    while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
      $userData['ALL'][] = $row;
    }
    echo json_encode($userData);
        
}

if( isset($_POST['limit']) && isset($_POST['stop']) ){  
    if( !empty($_POST['limit']) && !empty($_POST['stop']) ){
        $stoping = trim($_POST['stop']);
        var_dump($stoping);
         $stmt = $BD->prepare("UPDATE configuraciones SET limite_inscripciones=?");
         $stmt->bindParam(1, $stoping);
         // Excecute
         $stmt->execute();
         echo 'Actualizado el limite de inscripciones';

    }

}


//Inserta una nueva inscripcion de un usuario
if( isset($_POST['createInscriptions']) && isset($_POST['nombre']) && isset($_POST['apellidos'])  && isset($_POST['edad'])  && isset($_POST['telefono']) && isset($_POST['correo']) ){
    if( !empty($_POST['createInscriptions']) && !empty($_POST['nombre']) && !empty($_POST['apellidos'])  && !empty($_POST['edad'])  && !empty($_POST['telefono']) && !empty($_POST['correo']) ){
       
        $userName     = trim($_POST['nombre']);
       $userSurname   = trim($_POST['apellidos']);
       $userAge       = trim($_POST['edad']);
       $userPhone     = trim($_POST['telefono']);
       $userEmail     = trim($_POST['correo']);

       $checkedName    = checkedText($userName);
       $checkedSurname = checkedText($userSurname);
       $checkedAge     = checkedAge($userAge);
       $checkedPhone   = checkedPhone($userPhone);
       $checkedEmail   = checkedEmail($userEmail);

       if($checkedName && $checkedSurname && $checkedAge && $checkedPhone && $checkedEmail){

            $stmt = $BD->prepare("SELECT limite_inscripciones FROM configuraciones"); //Verifica el limite
            $stmt->execute();
            $result = $stmt->fetch();
            $recordLimit = $result[0]; 
            
            $stmt = $BD->prepare("SELECT COUNT(*) FROM inscripciones"); //cuenta el total de registros
            $stmt->execute();
            $count = $stmt->fetchColumn();

            if ($count >= $recordLimit){ //Condicion
                echo "reached_limit";
            }else{
            $stmt = $BD->prepare("INSERT INTO inscripciones (nombre, apellidos, edad, telefono, correo) VALUES (?, ?, ?, ?, ?)");
            $stmt->bindParam(1, $userName);
            $stmt->bindParam(2, $userSurname);
            $stmt->bindParam(3, $userAge);
            $stmt->bindParam(4, $userPhone);
            $stmt->bindParam(5, $userEmail);
            $stmt->execute();
            echo 'true';
            } 

       }else{
           echo "false";
       }
       

   }else{
       echo "empty_fields";
   }
}

//Edita la inscripcion de un usuario
if( isset($_POST['editInscription']) ){
    $idUser = trim($_POST['editInscription']);
    
    // Preparacion BD Consulta automatica
    $stmt = $BD->prepare("SELECT nombre, apellidos, edad, telefono, correo FROM inscripciones WHERE id = :id");
    $stmt->bindParam (':id', $idUser);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if($result > 0 ){
    echo json_encode($result);

    }else{
        echo '<div class="alert alert-danger" role="alert">
            No existe el usuario
        </div>';
    };

}

//Actualiza la inscripcion del usuario
if( isset($_POST['updateInscriptions']) && isset($_POST['nombre']) && isset($_POST['apellidos'])  && isset($_POST['edad'])  && isset($_POST['telefono']) && isset($_POST['correo']) ){
    
    //Verificacion
    if( !empty($_POST['nombre']) && !empty($_POST['apellidos'])  && !empty($_POST['edad'])  && !empty($_POST['telefono']) && !empty($_POST['correo']) ){
        
        $userId      = trim($_POST['updateInscriptions']);
        $usernName   = trim($_POST['nombre']);
        $userSurname = trim($_POST['apellidos']);
        $userAge     = trim($_POST['edad']);
        $userPhone   = trim($_POST['telefono']);
        $userEmail   = trim($_POST['correo']);
       
        $letterSpace = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
        $onlyEmail   = "/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/";

        //Verification
        if (!preg_match($letterSpace, $usernName)) {
          echo "error_letters";
        }
        elseif (!preg_match($onlyEmail, $userEmail)) {
          echo "error_email";
        }
        else{
          // Prepare
          $stmt = $BD->prepare("UPDATE inscripciones SET nombre=?, apellidos=?, edad=?, telefono=?, correo=? WHERE id=$userId ");
          $stmt->bindParam(1, $usernName);
          $stmt->bindParam(2, $userSurname);
          $stmt->bindParam(3, $userAge);
          $stmt->bindParam(4, $userPhone);
          $stmt->bindParam(5, $userEmail);
          // Excecute
          $stmt->execute();
          echo 'userUpdate';
        }
    }
}

//Eliminar inscripcion de un usuario
if( isset($_POST['deleteInscriptions'])  ){
    // Prepare
    $userId = trim($_POST['deleteInscriptions']);
    $stmt = $BD->prepare("DELETE FROM inscripciones WHERE id=$userId ");
    $stmt->execute();
    echo "true";

}

//Resetear toda la tabla
if(isset($_POST["deleteInscriptionsAll"]) ){
    // Prepare
    $stmt = $BD->prepare("DELETE FROM inscripciones");
    $stmt->execute();
    echo "true";
}