<?php 
// session_start();
require '../config/database.php';
require '../dashboard/Sesiones.php';
require 'validations.php';
$idUser;
/*
Este archivo contiene las siguientes opciones:
Consultas, Actualiza el usuario, Actualizar recordatorio
*/

//consulta la informacion del usuario
if( isset($idUser) ){
 $stmt = $BD->prepare("SELECT nombre, correo, recordatorio, perfil, rol, foto FROM usuarios WHERE id = :id");
 $stmt->bindParam (':id', $idUser);
 $stmt->execute();
 $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if($result > 0 ){
    //Variables sesion
    $nameUser     = $result['nombre'];
    $mailUser     = $result['correo'];
    $rememberUser = $result['recordatorio'];
    $perfilUser   = $result['perfil'];
    $rolUser      = $result['rol'];
    $imageUser    = $result['foto'];


    /* //EN CASO DE QUE NO EXISTA LA FOTO, PONER UNA POR DEFAULT 
    $resetName = explode("../../assets/user/profile/", $imageUser);
    $path_profile_save = "../assets/user/profile/";

      if(!file_exists($path_profile_save . $resetName)) {
        $nuevo = "../assets/user/profile/default2.gif";
        return $nuevo;
      }else{
        echo "No agregar";
      }
     */
    

  
  }else{
    echo 'No existe el usuario';
  };
}

//Actuliza usuario
if( 
  isset($_POST['upData']) && 
  isset($_POST['nombre']) && 
  isset($_POST['correo']) 
){
  if( 
    !empty($_POST['upData']) && 
    !empty($_POST['nombre']) && 
    !empty($_POST['correo']) 
  ){
      $userId    = trim($_POST['upData']);
      $usernName = trim($_POST['nombre']);
      $userEmail = trim($_POST['correo']);

      $checkedName  = checkedText($usernName);
      $checkedEmail = checkedEmail($userEmail);

      if( $checkedName && $checkedEmail){
        $stmt = $BD->prepare("UPDATE usuarios SET nombre=?, correo=? WHERE id=$userId ");
        $stmt->bindParam(1, $usernName);
        $stmt->bindParam(2, $userEmail);
        $stmt->execute();
        echo 'true';
      }else{
        echo "data_invalid";
      }
  }else{
    echo "empty_fields";
  }
}

//Actuliza recordatorio
if( 
    isset($_POST['upDataRemember']) && 
    isset($_POST['recordatorio']) 
){
  if( 
      !empty($_POST['upDataRemember']) && 
      !empty($_POST['recordatorio']) 
  ){         
    $userId           = trim($_POST['upDataRemember']);
    $userRemember     = trim($_POST['recordatorio']);
    $checkedRemember  = checkedNormal($userRemember);

    if( $checkedRemember == true){
        $stmt = $BD->prepare("UPDATE usuarios SET recordatorio=? WHERE id=$userId ");
        $stmt->bindParam(1, $userRemember);
        $stmt->execute();
        echo 'true';
    }else{
      echo "data_invalid";
    }
  }else{
    echo "empty_fields";
  }
}


if( 
  isset($_FILES["file"]) && 
  isset($_POST["idUser"]) && 
  !empty($_FILES["file"]) && 
  !empty($_POST["idUser"]) 
){
  $userId       = $_POST["idUser"];
  $file_name    = $_FILES["file"]["name"];
  $file_tmpname = $_FILES["file"]["tmp_name"];
  $file_size    = $_FILES['file']['size'];
  $file_error   = $_FILES['file']['error'];
  $file_type    = $_FILES["file"]["type"];
  //Ruta donde se guardara la imagen
  $path_profile_save = "../assets/user/profile/";
  //Formato de imagen
  if ( 
    ($file_type == "image/png")     || 
    ($file_type == "image/jpeg")    || 
    ($file_type == "image/jpg")     || 
    ($file_type == "image/svg")     || 
    ($file_type == "image/svg+xml") ||
    ($file_type == "image/gif")     //dimenciones del GIF: 400x400
  ){
      if ($file_size <= 500000) {
            if ($file_error == 0){
              if(!file_exists($path_profile_save . $file_name)) {
                  move_uploaded_file ($file_tmpname, "$path_profile_save".$file_name);
                  //DESPUES DE LA VALIDACION DEBEMOS GUARDAR
                  $path_image_user = "../../assets/user/profile/".$file_name;
                  $stmt = $BD->prepare("UPDATE usuarios SET foto=? WHERE id=$userId");
                  $stmt->bindParam(1, $path_image_user);
                  $stmt->execute();
                  //RESPONDEMOS
                  echo "true ", $path_image_user;  
              }else{
                echo "exist_file";
              }
          } else {
              //EN CASO DE QUE EXISTA UN ERROR
              echo "fail";
              die();
          }
      }
  }
}



//consulta redes sociales
if( isset($idUser) ){
  $stmt = $BD->prepare("SELECT * FROM redes_sociales");
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
 
   if($result > 0 ){
     //Variables sesion
     $Facebook = $result['facebook'];
     $Whatsapp = $result['whatsapp'];
     $Instagram = $result['instagram'];
     $Youtube = $result['youtube'];
     $Web = $result['web'];
     $Email = $result['correo'];
   }else{
     echo '<div class="alert alert-danger" role="alert">
       No existe el usuario
       </div>';
   };
 }

//Actuliza redes sociales
if( 
  isset($_POST['useridSocialmedia']) && 
  isset($_POST['facebook']) && 
  isset($_POST['whatsapp']) && 
  isset($_POST['instagram']) && 
  isset($_POST['youtube']) && 
  isset($_POST['web']) && 
  isset($_POST['correo']) 
){
  if( 
    !empty($_POST['useridSocialmedia']) && 
    !empty($_POST['facebook']) && 
    !empty($_POST['whatsapp']) && 
    !empty($_POST['instagram']) && 
    !empty($_POST['youtube']) && 
    !empty($_POST['web']) && 
    !empty($_POST['correo'])  
  ){
            
    $userId    = trim($_POST['useridSocialmedia']);
    $facebook  = trim($_POST['facebook']);
    $whatsapp  = trim($_POST['whatsapp']);
    $instagram = trim($_POST['instagram']);
    $youtube   = trim($_POST['youtube']);
    $web       = trim($_POST['web']);
    $email     = trim($_POST['correo']);

    $checkedFacebook  = checkedSocialFacebook($facebook);
    $checkedWhatsapp  = checkedPhone($whatsapp);
    $checkedInstagram = checkedSocialInstagram($instagram);
    $checkedInstagram = checkedSocialYoutube($youtube);
    $checkedWeb       = checkedSocialWeb($web);
    $checkedCorreo    = checkedEmail($email);

    if( $checkedFacebook && 
        $checkedWhatsapp &&  
        $checkedInstagram && 
        $checkedInstagram && 
        $checkedWeb &&  
        $checkedCorreo == true){ //No es necesario el true

        $ApiWhatsapp = 'https://api.whatsapp.com/send?phone='.$whatsapp;
        $stmt = $BD->prepare("UPDATE redes_sociales SET facebook=?, whatsapp=?, instagram=?, youtube=?, web=?, correo=? WHERE id=$userId ");
        $stmt->bindParam(1, $facebook);
        $stmt->bindParam(2, $ApiWhatsapp);
        $stmt->bindParam(3, $instagram);
        $stmt->bindParam(4, $youtube);
        $stmt->bindParam(5, $web);
        $stmt->bindParam(6, $email);
        $stmt->execute();
        echo 'true';

    }else{
      echo "data_invalid";
    }
  }else{
    echo "empty_fields";
  }
}