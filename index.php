<?php
//$uc = $_GET['uc'];

require_once 'includes/classPDO.php';
require_once 'includes/ftc.php';

$bdd=PdoMaaserApp::getPdoMaaserApp();

$uc = filter_input(INPUT_GET, 'uc', FILTER_SANITIZE_SPECIAL_CHARS);
if(empty($uc)){
    $uc = "accueil";
}
switch ($uc) {
    case 'connexion':
        include 'controleurs/c_connexion.php';
        break;
    case 'accueil':
        include 'controleurs/c_accueil.php';
        break;
    case 'inscription':
        include 'controleurs/c_inscription.php';
        break;
}
?>

