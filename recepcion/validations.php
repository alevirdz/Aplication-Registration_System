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
function checkedIdUser($idUser){
    $isCorrect = false;
    return (1 === preg_match('/^[0-9]{1,}$/', $idUser, $isCorrect ));
}
function checkedAge($age){
    $isCorrect = false;
    return (1 === preg_match('/^[0-9]{2}$/', $age, $isCorrect ));
}
function checkedNumber($number){
    $isCorrect = false;
    return (1 === preg_match('/^[0-9]{1,}$/', $number, $isCorrect ));
}
function checkedPassword($pass){
    $isCorrect = false;
    // /debe contener al menos entre 6 a 10 caracteres
    //caracteres permitos a z A Z, @#$%-_.
    return (1 === preg_match('/^[a-zA-Z0-9\.@\-_#%$]{6,18}$/', $pass, $isCorrect ));
}
function checkedLimit($limit){
    $isCorrect = false;
    return (1 === preg_match('/^[0-9]{2}$/', $limit, $isCorrect ));
}
function checkedSocialFacebook($social){
    $isCorrect = false;
    return (1 === preg_match('/https:\/\/www\.facebook\.com\/+/', $social, $isCorrect ));
}
function checkedSocialWhatsapp($social){
    $isCorrect = false;
    /* return (1 === preg_match('/https:\/\/www\.facebook\.com\/+/', $social, $isCorrect )); */
    /* return (1 === preg_match('/https:\/\/www\.instagram\.com\/+/', $social, $isCorrect )); */
    /* return (1 === preg_match('/https:\/\/www\.youtube\.com\/watch\?v=[^&]+/', $social, $isCorrect )); */
   /*  return (1 === preg_match('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i', $social, $isCorrect )); */
}
function checkedSocialInstagram($social){
    $isCorrect = false;
    return (1 === preg_match('/https:\/\/www\.instagram\.com\/+/', $social, $isCorrect ));
}
function checkedSocialYoutube($social){
    $isCorrect = false;
    return (1 === preg_match('/https:\/\/www\.youtube\.com\/+/', $social, $isCorrect ));
}
function checkedSocialWeb($social){
    $isCorrect = false;
   return (1 === preg_match('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i', $social, $isCorrect ));
}
function checkedLocation ($userLocation){
    switch($userLocation){
        case 01:
            return  'Merida';
        break;
        case 02:
            return 'Caucel';
        break;
        case 03:
            return 'Kanasín';
        break;
        case 04:
            return 'Umán';
        break;
        case 05:
            return 'Otro';
        break;
        default:
            return null;
    }
}
function checkedVisit ($userVisit){
    switch($userVisit){
        case 01:
            return  'Joven';
        break;
        case 02:
            return 'Adulto';
        break;
        default:
            return null;
    }
}


























// function key($querys) {
//     $querysBD = array('create', 'insert', 'update', 'delete', 'drop', 'select', 'alter');
//     foreach ($querysBD as $query) {
//        echo $query;
//     }
//     return trim($querys);
// }