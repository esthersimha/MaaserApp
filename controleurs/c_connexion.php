<?php
include 'vues/v_connexion.php';

$action = filter_input(INPUT_GET,'action',FILTER_SANITIZE_SPECIAL_CHARS);

switch($action){
    case 'verifierConnexion':
        
        $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_SPECIAL_CHARS);
        $mdp = filter_input(INPUT_POST,'password',FILTER_SANITIZE_SPECIAL_CHARS);
        //var_dump($email,$mdp);

       $result= $bdd->verifierConnexion($email);

        if($result){
            //var_dump($result);
            $mdpHach = $result['mdp'];
            if(password_verify($mdp, $mdpHach)){
                
                $_SESSION['user'] = [
                    'id' =>$result['id'],
                    'nom' =>$result['nom'],
                    'prenom' =>$result['prenom'],
                    'email' =>$result['email']
                ];
                $message= "Connexion réussie ! Bienvenue ";
                echo $message;
                //include 'vues/v_message.php;
                header('Refresh:3; index.php?uc=menuPrincipal');
        }else{
          
            $message = "Mot de passe incorrect. Veuillez réessayer.";
            echo $message;
            //include 'vues/v_message.php;
            header('Refresh:3;index.php?uc=connexion');
        }

        }else{
            $message = "Aucun utilisateur trouvé avec cet email.";
            echo $message;
            header('index.php?uc=connexion');
        }
        break;
    }        
?>