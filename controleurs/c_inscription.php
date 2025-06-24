<?php
include 'vues/v_inscription.php';
$action = filter_input(INPUT_GET,'action',FILTER_SANITIZE_SPECIAL_CHARS);

switch($action){
    case 'nouvelUtilisateur':
        $nom = filter_input(INPUT_POST,'lastname',FILTER_SANITIZE_SPECIAL_CHARS);
        $prenom = filter_input(INPUT_POST,'firstname',FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_SPECIAL_CHARS);
        $mdp = filter_input(INPUT_POST,'password',FILTER_SANITIZE_SPECIAL_CHARS);
        $confirmMdp = filter_input(INPUT_POST,'confirm_password',FILTER_SANITIZE_SPECIAL_CHARS);

        if($mdp == $confirmMdp){
            $mdpHach= password_hash($mdp, PASSWORD_DEFAULT);
            $bdd->creerNouvelUtilisateur($nom,$prenom,$email,$mdpHach);

        }else{
            echo 'mdp incorrect';
            //$message =;
            //include 'vues/v_erreur.php';
            header('Refresh:3;Location:index.php?uc=inscription');
        }
        break;
}
?>