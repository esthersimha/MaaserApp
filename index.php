<?php
//$uc = $_GET['uc'];

require_once 'includes/classPDO.php';
require_once 'includes/ftc.php';

session_start();

$estConnecte = estConnecte();

$bdd=PdoMaaserApp::getPdoMaaserApp();

$uc = filter_input(INPUT_GET, 'uc', FILTER_SANITIZE_SPECIAL_CHARS);

if(empty($uc) && $estConnecte){
    $uc = "menuPrincipal";
}elseif(empty($uc)){
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

    case 'menuPrincipal':
        include 'vues/v_menu_principal.php';
        break;

    case 'declarerRevenu':
        include 'controleurs/c_declarer_revenu.php';
        break;

    case 'declarerDon':
        include 'controleurs/c_declarer_don.php';
        break; 

    case 'tableauRecapitulatif':
        include 'controleurs/c_recap.php';
        break; 

    case 'personnaliser':
        include 'controleurs/c_personnaliser.php';
        break;
}
?>

