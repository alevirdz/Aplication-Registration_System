<?php 
//ID del usuario
$idUser;

$stmt = $BD->prepare("SELECT nombre, correo, recordatorio, perfil, rol, foto FROM usuarios WHERE id = :id");
$stmt->bindParam (':id', $idUser);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$nameUser = $result['nombre'];
$imageUser = $result['foto'];
// Preparacion BD Consulta automatica Inscripciones
$stmt = $BD->prepare("SELECT * FROM inscripciones;" );
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_OBJ);
$inscriptions = COUNT($result);   
$inscriptions;    
// Preparacion BD Consulta automatica Visitas nuevas
$stmt = $BD->prepare("SELECT * FROM visita_nuevas;" );
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_OBJ);
$newPerson = COUNT($result);   
$newPerson;  
// Preparacion BD Consulta automatica Usuarios
$stmt = $BD->prepare("SELECT * FROM usuarios");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_OBJ);
$usuarios = COUNT($result); 
// Preparacion BD Consulta automatica Donaciones
$stmt = $BD->prepare("SELECT * FROM donaciones");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_OBJ);
$begintotal = 0;
foreach( $result as $data ){$begintotal += (double)$data->donacion;}
$totalDonation =  number_format($begintotal, 2, '.', ',');
// Preparacion BD Consulta automatica Usuarios Sistema
$stmt = $BD->prepare("SELECT * FROM usuarios");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_OBJ);
$tableUser = $result;







