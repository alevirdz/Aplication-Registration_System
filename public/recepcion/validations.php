<?php 
function checkedText($text){
    $isCorrect = false;
    return (1 === preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/', $text, $isCorrect ));
}
function checkedNormal($normal){
    $isCorrect = false;
    return (1 === preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ:,;_@#\-.s]+$/', $normal, $isCorrect ));
}
function checkedEmail($email){
    $isCorrect = false;
    return (1 === preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $email, $isCorrect));
}
function checkedMoneda($moneda){
    $isCorrect = false;
    return (1 === preg_match('/^[, .]+$/', $moneda, $isCorrect ));
}
function checkedPhone($phone){
    // $phone = '000-0000-0000';
    // /^[0-9]{3}-[0-9]{4}-[0-9]{4}$/
    $isCorrect = false;
    return (1 === preg_match('/^[0-9]{2}[0-9]{10}$/', $phone, $isCorrect ));
}
function checkedAge($age){
    $isCorrect = false;
    return (1 === preg_match('/^[0-9]{2}$/', $age, $isCorrect ));
}
function checkedPassword($pass){
    $isCorrect = false;
    // /debe contener al menos entre 6 a 10 caracteres
    //caracteres permitos a z A Z, @#$%-_.
    return (1 === preg_match('/^[a-zA-Z0-9\.@\-_#%$]{6,18}$/', $pass, $isCorrect ));
}





 

























// function key($querys) {
//     $querysBD = array('create', 'insert', 'update', 'delete', 'drop', 'select', 'alter');
//     foreach ($querysBD as $query) {
//        echo $query;
//     }
//     return trim($querys);
// }