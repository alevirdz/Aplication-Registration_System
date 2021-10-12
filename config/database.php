<?php
include ("configuration.php");

$server   = HOST;
$database = DATABASE;
$username = USER;
$password = PWD;
$port     = PORT;

try {
  $con = "mysql:host=$server;port=$port;dbname=$database";
  $options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  );
  $BD = new PDO($con, $username, $password);
} catch (PDOException $e){
  //show error
  echo '<p class="bg-danger">'.'Mensaje de conexion: '.$e->getMessage().'</p>';
  exit;
}

?>
