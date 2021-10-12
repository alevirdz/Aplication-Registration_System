<?php 
require '../config/database.php';
require 'validations.php';
/*
Este archivo contiene las siguientes opciones:
Insertar
*/

//Inserta un nuevo usuario con un tipo de rol
if( isset($_POST['rol_usuario']) && isset($_POST['tipo_perfil']) && isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['contraseña'])  && isset($_POST['contraseña_d']) ){
    //Verificacion
    if( !empty($_POST['rol_usuario']) && !empty($_POST['tipo_perfil']) && !empty($_POST['nombre']) && !empty($_POST['correo']) && !empty($_POST['contraseña'])  && !empty($_POST['contraseña_d']) ){
       $username    = $_POST['nombre'];
       $userEmail   = $_POST['correo'];
       $userPwd     = $_POST['contraseña'];
       $iqualPwd    = $_POST['contraseña_d'];
       $rolUser     = $_POST['rol_usuario'];
       $typeProfile = $_POST['tipo_perfil'];

       $checkedName = checkedText($username);
       $checkedEmail = checkedEmail($userEmail);
       $checkedPwd = checkedPassword($userPwd);
       $checkedIPwd = checkedPassword($iqualPwd);

        if($checkedName && $checkedEmail && $checkedPwd && $checkedIPwd == true){
            if( $userPwd != $iqualPwd ){
            echo 'pwd_not_match';
            }else{
                // Preparacion BD
               $stmt = $BD->prepare("SELECT correo FROM usuarios WHERE correo = :correo");
               $stmt->execute(array(':correo' => $userEmail));
               $row = $stmt->fetch(PDO::FETCH_ASSOC);
           
               //Si coincide
               if(!empty($row['correo'])){
                   echo 'mail_use';
               }else{
                   $defaultRemember = 'Este es un espacio para agregar un mensaje personal, como una cita, un recordatorio o un mensaje positivo...';
                   $status = "Activo";
                   $photo = "../../assets/user/profile/default_1.gif";
                   // Prepare
                   $stmt = $BD->prepare("INSERT INTO usuarios (nombre, correo, contrasena, recordatorio, perfil, rol, estado, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                   $hashedPwd = password_hash( $userPwd, PASSWORD_BCRYPT);
                   $stmt->bindParam(1, $username);
                   $stmt->bindParam(2, $userEmail);
                   $stmt->bindParam(3, $hashedPwd);
                   $stmt->bindParam(4, $defaultRemember);
                   $stmt->bindParam(5, $typeProfile);
                   $stmt->bindParam(6, $rolUser);
                   $stmt->bindParam(7, $status);
                   $stmt->bindParam(8, $photo);
                   // Excecute
                   $stmt->execute();
                   echo 'true';
                } //final de validacion de correo
            }//final si todo es correcto
        }else{ echo "data_invalid";}
   }else{ echo "empty_fields"; }
}


//Consulta en la base de datos
if( isset($_POST['showUsers']) ){
    // Preparacion BD Consulta automatica
    $stmt = $BD->prepare("SELECT * FROM usuarios");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);

     if($result ){
        //returns data as JSON format
        echo json_encode($result);
     }else{
       echo '<div class="alert alert-danger" role="alert">
         No existe el usuario
         </div>';
     };
        
}

//Eliminar inscripcion de un usuario
if( isset($_POST['deleteUser'])  ){
    // Prepare
    $userId = trim($_POST['deleteUser']);
    $stmt = $BD->prepare("DELETE FROM usuarios WHERE id=$userId ");
    $stmt->execute();
    echo "true";

}

//activar usuario de un usuario
if( isset($_POST['activar'])  && !empty($_POST['activar']) ){
    // Prepare
    $userId = trim($_POST['activar']);
    $checkedUserId  = checkedNumber($userId);
    if( $checkedUserId == true ){
        $active = 'Activo';
        $stmt = $BD->prepare("UPDATE usuarios SET estado=?  WHERE id=$userId");
        $stmt->bindParam(1, $active);
        $stmt->execute();
        echo "true";
    
    }else{
      echo "data_invalid";
    }


}
//desactivar usuario
if( isset($_POST['desactivar'])  && !empty($_POST['desactivar']) ){
    // Prepare
    $userId = trim($_POST['desactivar']);
    $checkedUserId  = checkedNumber($userId);
    if( $checkedUserId == true ){
        $desactive = 'Desactivado';
        $stmt = $BD->prepare("UPDATE usuarios SET estado=?  WHERE id=$userId");
        $stmt->bindParam(1, $desactive);
        $stmt->execute();
        echo "true";
    
    }else{
      echo "data_invalid";
    }


}