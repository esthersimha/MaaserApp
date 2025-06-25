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

        $emailExist =$bdd->verifEmailExist($email);

        if($mdp == $confirmMdp && !$emailExist){
            $mdpHach= password_hash($mdp, PASSWORD_DEFAULT);
            $etat = $bdd->creerNouvelUtilisateur($nom,$prenom,$email,$mdpHach);
            if($etat){
                $message = "Inscription réussie !";
                echo $message;
                //include 'vues/v_message.php';
                header('Refresh:3;index.php?uc=connexion');
            }else{
                $message = "L'inscription a échouée, veuillez réessayer.";
                include 'vues/v_message.php';
                header('Refresh:3;index.php?uc=inscription');
            }

        }else{
            $message = "Le mot de passe de confirmation ne correspond pas au mot de passe ou l'email existe déjà ";
            // include 'vues/v_message.php';
            echo $message;
            header('Refresh:3;index.php?uc=inscription');
        }
        break;
}
?>