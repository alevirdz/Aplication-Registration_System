<?php 
require '../config/database.php';
require 'validations.php';

//Consulta todo
if( isset($_POST['showRegister']) )
{
    $stmt = $BD->prepare("SELECT * FROM visita_nuevas");
    $stmt->execute();
    $userData = array();
    while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
    $userData['ALL'][] = $row;}
    echo json_encode($userData);     
}

//Se crean registros
if( 
    isset($_POST['createNewPerson']) && 
    isset($_POST['nombre']) && 
    isset($_POST['apellidos'])  && 
    isset($_POST['telefono']) && 
    isset($_POST['ubicacion']) && 
    isset($_POST['visitante']) 
){
    if( !empty($_POST['createNewPerson']) && 
        !empty($_POST['nombre']) && 
        !empty($_POST['apellidos'])  && 
        !empty($_POST['telefono']) && 
        !empty($_POST['ubicacion']) && 
        !empty($_POST['visitante'])
    ){
       $userName        = trim($_POST['nombre']);
       $userSurname     = trim($_POST['apellidos']);
       $userPhone       = trim($_POST['telefono']);
       $userLocation    = trim($_POST['ubicacion']);
       $userVisit       = trim($_POST['visitante']);

       $checkedName         = checkedText($userName);
       $checkedSurname      = checkedText($userSurname);
       $checkedPhone        = checkedPhone($userPhone);
       $checkedLocation     = checkedNumber($userLocation); //Comprueba Número
       $checkedLocationExist= checkedLocation($userLocation);//Valida que exista
       $checkedVisit        = checkedNumber($userVisit); //Comprueba Número
       $checkedVisitExist   = checkedVisit($userVisit); //Valida que exista

       if(  
        $checkedName && 
        $checkedSurname && 
        $checkedPhone && 
        $checkedLocation &&
        $checkedVisit 
        ){  
           
            if($checkedVisitExist && $checkedLocationExist != null){
                $stmt = $BD->prepare("INSERT INTO visita_nuevas (nombres, apellidos, telefono, ubicacion, visitante ) VALUES (?, ?, ?, ?, ?)");
                $stmt->bindParam(1, $userName);
                $stmt->bindParam(2, $userSurname);
                $stmt->bindParam(3, $userPhone);
                $stmt->bindParam(4, $checkedLocationExist);
                $stmt->bindParam(5, $checkedVisitExist);
                $stmt->execute();
                echo 'true'; 
            }else{
                echo 'not_exit_option';
            }
                
        }else{
            echo "data_invalid";
        }
       
    }else{
        echo "empty_fields";
    }
    
}

//Edita
if( isset($_POST['editRegisterNewPerson']) &&
    !empty($_POST['editRegisterNewPerson']) )
{
    $idUser = trim($_POST['editRegisterNewPerson']);
    $stmt = $BD->prepare("SELECT nombres, apellidos, telefono, ubicacion, visitante FROM visita_nuevas WHERE id = :id");
    $stmt->bindParam (':id', $idUser);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if($result > 0 ){
    echo json_encode($result);}else{
    echo 'No_existe_usuario';};

}

//Se actualizan registros
if( 
    isset($_POST['UpdateNewPersonID']) && 
    isset($_POST['nombre']) && 
    isset($_POST['apellidos'])  && 
    isset($_POST['telefono']) && 
    isset($_POST['ubicacion']) && 
    isset($_POST['visitante'])  
){
    if( !empty($_POST['UpdateNewPersonID']) && 
        !empty($_POST['nombre']) && 
        !empty($_POST['apellidos'])  && 
        !empty($_POST['telefono']) && 
        !empty($_POST['ubicacion']) && 
        !empty($_POST['visitante'])
    ){
        $userId          = trim($_POST['UpdateNewPersonID']);
        $userName        = trim($_POST['nombre']);
        $userSurname     = trim($_POST['apellidos']);
        $userPhone       = trim($_POST['telefono']);
        $userLocation    = trim($_POST['ubicacion']);
        $userVisit       = trim($_POST['visitante']);
        
       $checkedID           = checkedIdUser($userId);
       $checkedName         = checkedText($userName);
       $checkedSurname      = checkedText($userSurname);
       $checkedPhone        = checkedPhone($userPhone);
       $checkedLocation     = checkedNumber($userLocation); //Comprueba Número
       $checkedLocationExist= checkedLocation($userLocation);//Valida que exista
       $checkedVisit        = checkedNumber($userVisit); //Comprueba Número
       $checkedVisitExist   = checkedVisit($userVisit); //Valida que exista

       if(  
        $checkedID &&
        $checkedName && 
        $checkedSurname && 
        $checkedPhone && 
        $checkedLocation &&
        $checkedVisit 
        ){  
           
            if($checkedVisitExist && $checkedLocationExist != null){
                $stmt = $BD->prepare("UPDATE visita_nuevas SET nombres=?, apellidos=?, telefono=?, ubicacion=?, visitante=? WHERE id=$userId ");
                $stmt->bindParam(1, $userName);
                $stmt->bindParam(2, $userSurname);
                $stmt->bindParam(3, $userPhone);
                $stmt->bindParam(4, $checkedLocationExist);
                $stmt->bindParam(5, $checkedVisitExist);
                $stmt->execute();
                echo 'true'; 
            }else{
                echo 'not_exit_option';
            }
                
        }else{
            echo "data_invalid";
        }
       
    }else{
        echo "empty_fields";
    }
    
}

//Eliminar inscripcion de un usuario
if( isset($_POST['deleteNewPerson']) )
{
    $userId = trim($_POST['deleteNewPerson']);
    $stmt = $BD->prepare("DELETE FROM visita_nuevas WHERE id=$userId ");
    $stmt->execute();
    echo "true";
}

//Resetear tabla
if(isset($_POST["deleteNewVisitAll"]) )
{
    $userId = trim($_POST['deleteNewVisitAll']);
    $stmt = $BD->prepare("DELETE FROM visita_nuevas");
    $stmt->execute();
    echo "true";
}




