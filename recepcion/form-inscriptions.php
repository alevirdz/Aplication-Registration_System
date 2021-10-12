<?php 
require '../config/database.php';
require 'validations.php';
/*
Este archivo contiene las siguientes opciones:
Consultas, Insertar, Editar, Actualizar, Eliminar, Resetear
*/


//Consulta la base de datos para mostrar la tabla
if( isset($_POST['showRegister']) )
{
    $stmt = $BD->prepare("SELECT * FROM inscripciones");
    $stmt->execute();
    $userData = array();
    while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
    $userData['ALL'][] = $row;}
    echo json_encode($userData);     
}

//Se establece limite
if( isset($_POST['limit']) && 
    isset($_POST['stop']) && 
    !empty($_POST['limit']) && 
    !empty($_POST['stop']))
{
    $stoping = trim($_POST['stop']);
    $stmt = $BD->prepare("UPDATE configuraciones SET limite_inscripciones=?");
    $stmt->bindParam(1, $stoping);
    $stmt->execute();
    //echo 'Update_limit_inscriptions';
    echo "true";
}


//Inserta una nueva inscripcion de un usuario
if( 
    isset($_POST['createInscriptions']) && 
    isset($_POST['nombre']) && 
    isset($_POST['apellidos'])  && 
    isset($_POST['edad'])  && 
    isset($_POST['telefono']) && 
    isset($_POST['correo']) && 
    isset($_POST['asignacion']) && 
    isset($_POST['abono'])
){
    if( !empty($_POST['createInscriptions']) && 
        !empty($_POST['nombre']) && 
        !empty($_POST['apellidos'])  && 
        !empty($_POST['edad'])  && 
        !empty($_POST['telefono']) && 
        !empty($_POST['correo']) && 
        !empty($_POST['asignacion']) && 
        !empty($_POST['abono']) 
    ){
       
       $userName        = trim($_POST['nombre']);
       $userSurname     = trim($_POST['apellidos']);
       $userAge         = trim($_POST['edad']);
       $userPhone       = trim($_POST['telefono']);
       $userEmail       = trim($_POST['correo']);
       $userAsignation  = trim($_POST['asignacion']);
       $userAbono       = trim($_POST['abono']);

       $checkedName         = checkedText($userName);
       $checkedSurname      = checkedText($userSurname);
       $checkedAge          = checkedAge($userAge);
       $checkedPhone        = checkedPhone($userPhone);
       $checkedEmail        = checkedEmail($userEmail);
       $checkedAsignation   = checkedNumber($userAsignation);
       $checkedAbono        = checkedNumber($userAbono);

       if(  
            $checkedName && 
            $checkedSurname && 
            $checkedAge && 
            $checkedPhone && 
            $checkedEmail &&
            $checkedAsignation &&
            $checkedAbono
        ){
            //Verifica el limite
            $stmt = $BD->prepare("SELECT limite_inscripciones FROM configuraciones"); 
            $stmt->execute();
            $result = $stmt->fetch();
            $recordLimit = $result[0]; 
            //cuenta el total de registros
            $stmt = $BD->prepare("SELECT COUNT(*) FROM inscripciones"); 
            $stmt->execute();
            $count = $stmt->fetchColumn();
            //Condicion
            if ($count >= $recordLimit){ 
                echo "reached_limit";
            }else{

                $Invited = "Invitado";
                $Servant = "Servidor";

                switch($userAsignation){
                    case 01:
                        $stmt = $BD->prepare("INSERT INTO inscripciones (nombre, apellidos, edad, telefono, correo, asignacion, abono ) VALUES (?, ?, ?, ?, ?, ?, ?)");
                        $stmt->bindParam(1, $userName);
                        $stmt->bindParam(2, $userSurname);
                        $stmt->bindParam(3, $userAge);
                        $stmt->bindParam(4, $userPhone);
                        $stmt->bindParam(5, $userEmail);
                        $stmt->bindParam(6, $Invited);
                        $stmt->bindParam(7, $userAbono);
                        $stmt->execute();
                        echo 'true';
                        break;
                    case 02:
                        $stmt = $BD->prepare("INSERT INTO inscripciones (nombre, apellidos, edad, telefono, correo, asignacion, abono ) VALUES (?, ?, ?, ?, ?, ?, ?)");
                        $stmt->bindParam(1, $userName);
                        $stmt->bindParam(2, $userSurname);
                        $stmt->bindParam(3, $userAge);
                        $stmt->bindParam(4, $userPhone);
                        $stmt->bindParam(5, $userEmail);
                        $stmt->bindParam(6, $Servant);
                        $stmt->bindParam(7, $userAbono);
                        $stmt->execute();
                        echo 'true';
                        break;
                    default: 
                        echo "not_exit_option";
                        break;
                }

            } 

       }else{
           echo "data_invalid";
       }
   }else{
       echo "empty_fields";
   }
}

//Edita la inscripcion de un usuario
if( isset($_POST['editInscription']) &&
    !empty($_POST['editInscription']) )
{
    $idUser = trim($_POST['editInscription']);
    $stmt = $BD->prepare("SELECT nombre, apellidos, edad, telefono, correo, asignacion, abono FROM inscripciones WHERE id = :id");
    $stmt->bindParam (':id', $idUser);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if($result > 0 ){
    echo json_encode($result);}else{
    echo 'No_existe_usuario';};

}

//Actualiza la inscripcion del usuario
if( 
        isset($_POST['updateInscriptions']) && 
        isset($_POST['nombre']) && 
        isset($_POST['apellidos'])  && 
        isset($_POST['edad'])  && 
        isset($_POST['telefono']) && 
        isset($_POST['correo']) &&
        isset($_POST['asignacion']) &&
        isset($_POST['abono']) 
    ){
        if( !empty($_POST['nombre']) && 
            !empty($_POST['apellidos'])  && 
            !empty($_POST['edad'])  && 
            !empty($_POST['telefono']) && 
            !empty($_POST['correo']) &&
            !empty($_POST['asignacion']) && 
            !empty($_POST['abono']) 
        ){
            
            $userId         = trim($_POST['updateInscriptions']);
            $usernName      = trim($_POST['nombre']);
            $userSurname    = trim($_POST['apellidos']);
            $userAge        = trim($_POST['edad']);
            $userPhone      = trim($_POST['telefono']);
            $userEmail      = trim($_POST['correo']);
            $userAsignation = trim($_POST['asignacion']);
            $userAbono      = trim($_POST['abono']);
            
            $checkedName         = checkedText($usernName);
            $checkedSurname      = checkedText($userSurname);
            $checkedAge          = checkedAge($userAge);
            $checkedPhone        = checkedPhone($userPhone);
            $checkedEmail        = checkedEmail($userEmail);
            $checkedAsignation   = checkedNumber($userAsignation);
            $checkedAbono        = checkedNumber($userAbono);
        
        if( $checkedName && 
            $checkedSurname && 
            $checkedAge && 
            $checkedPhone && 
            $checkedEmail &&
            $checkedAsignation &&
            $checkedAbono
        ){
            $Invited = "Invitado";
            $Servant = "Servidor";
            
            switch($userAsignation){
                case 01:
                    //Actualiza la inscripcion
                    $stmt = $BD->prepare("UPDATE inscripciones SET nombre=?, apellidos=?, edad=?, telefono=?, correo=?, asignacion=?, abono=? WHERE id=$userId ");
                    $stmt->bindParam(1, $usernName);
                    $stmt->bindParam(2, $userSurname);
                    $stmt->bindParam(3, $userAge);
                    $stmt->bindParam(4, $userPhone);
                    $stmt->bindParam(5, $userEmail);
                    $stmt->bindParam(6, $Invited);
                    $stmt->bindParam(7, $userAbono);
                    $stmt->execute();
                    echo 'userUpdate';
                    break;
                case 02:
                    //Actualiza la inscripcion
                    $stmt = $BD->prepare("UPDATE inscripciones SET nombre=?, apellidos=?, edad=?, telefono=?, correo=?, asignacion=?, abono=? WHERE id=$userId ");
                    $stmt->bindParam(1, $usernName);
                    $stmt->bindParam(2, $userSurname);
                    $stmt->bindParam(3, $userAge);
                    $stmt->bindParam(4, $userPhone);
                    $stmt->bindParam(5, $userEmail);
                    $stmt->bindParam(6, $Servant);
                    $stmt->bindParam(7, $userAbono);
                    $stmt->execute();
                    echo 'userUpdate';
                    break;
                default: 
                    echo "not_exit_option";
                    break;

            }

        }
        else{
            echo "data_invalid";
        }
    }
    else{
        echo "empty_fields";
    }
}

//Eliminar inscripcion de un usuario
if( isset($_POST['deleteInscriptions']) )
{
    $userId = trim($_POST['deleteInscriptions']);
    $stmt = $BD->prepare("DELETE FROM inscripciones WHERE id=$userId ");
    $stmt->execute();
    echo "true";
}

//Resetear toda la tabla
if(isset($_POST["deleteInscriptionsAll"]) )
{
    $userId = trim($_POST['deleteInscriptionsAll']);
    $stmt = $BD->prepare("DELETE FROM inscripciones");
    $stmt->execute();
    echo "true";
}