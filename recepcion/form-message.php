<?php 
require '../config/database.php';
include('../../assets/lib/alteria/httpPHPAltiria.php');

if( 
  isset($_POST['sms']) && 
  isset($_POST['message']) 
){
    // Preparacion BD Consulta automatica
    $stmt = $BD->prepare("SELECT * FROM inscripciones");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    $messageSMS = $_POST['message'];

    if($result ){
            
      foreach( $result as $data ){
        $telefonos[] = $data->telefono;
      }

          $arrayNumber = $telefonos; //print_r( json_encode( $arrayNumber));

          $cadena = $arrayNumber;
            // XX, YY y ZZ se corresponden con los valores de identificacion del usuario en el sistema.
            $altiriaSMS = new AltiriaSMS();
            $altiriaSMS->setLogin('youalevi@gmail.com');
            $altiriaSMS->setPassword('xyv39ecb');
            // $altiriaSMS->setDomainId('test');
            $altiriaSMS->setDebug(true);

            //Use this ONLY with Sender allowed by altiria sales team
            // $altiriaSMS->setSenderId('TestAltiria');
            //Concatenate messages. If message length is more than 160 characters. It will consume as many credits as the number of messages needed
            //$altiriaSMS->setConcat(true);
            //Use unicode encoding (only value allowed). Can send ����� but message length reduced to 70 characters
            // $altiriaSMS->setEncoding('unicode');

            //$sDestination = '346xxxxxxxx con prefijo internacional';
            //$sDestination = array('346xxxxxxxx','346yyyyyyyy');
            $sDestination =  $cadena;

            //Mensaje al destinatario
            $response = $altiriaSMS->sendSMS($sDestination, $messageSMS);

            if (!$response){
            echo "El envio ha tenido en error";}
            else{
            echo $response;}

    }else{
       echo '<div class="alert alert-danger" role="alert">
         No existe el usuario
         </div>';
     };
        
}


// Para contratar el servicio:
/* 
Paquetes sms https://www.altiria.com.mx/comprar-paquetes-de-sms/
El numero de telefono se proporciona y es de tipo: 33445 [Anonimo]

*/ 





