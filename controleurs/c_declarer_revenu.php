<?php

$action = filter_input(INPUT_GET,'action',FILTER_SANITIZE_SPECIAL_CHARS);

$id = $_SESSION['user']['id'];

$SourceRevenuExist = $bdd->verifSourceRevenuExist($id);

if($SourceRevenuExist){
    include 'vues/v_declarer_revenu.php';
}else{
    //si aucune source de revenu n'existe on redirige luilisateur vers la page de personnalisation
    header('Refresh:1;index.php?uc=personnaliser');
}
?>