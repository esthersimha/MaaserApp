<?php
$action = filter_input(INPUT_GET,'action',FILTER_SANITIZE_SPECIAL_CHARS);

$sourceId = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);

$id = $_SESSION['user']['id'];

switch($action){
    case 'ajouterSourceRevenu':
        $newSourceRevenu = filter_input(INPUT_POST,'nouveau_revenu',FILTER_SANITIZE_SPECIAL_CHARS);
        //j'enregistre dans la bdd la nouvelle source de revenu
        $bdd->ajouterSourceRevenu($id, $newSourceRevenu);
       //$sources_revenu = $bdd->getSourceRevenu($id);
    
    break;

    case 'gestionSourceRevenu':

    $sourceId = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    // Ajouter une source de revenu
    if (isset($_POST['ajouter_revenu'])) {
        $newSourceRevenu = filter_input(INPUT_POST, 'nouveau_revenu', FILTER_SANITIZE_SPECIAL_CHARS);
        if (!empty($newSourceRevenu)) {
            $bdd->ajouterSourceRevenu($id, $newSourceRevenu);
        }

    // Modifier une source
    } elseif (isset($_POST['modifier'])) {
        $newLibelle = filter_input(INPUT_POST, 'new_libelle', FILTER_SANITIZE_SPECIAL_CHARS);
        if (!empty($sourceId) && !empty($newLibelle)) {
            $bdd->modifierSourceRevenu($sourceId, $newLibelle);
        }

    // Supprimer une source
    } elseif (isset($_POST['supprimer'])) {
        if (!empty($sourceId)) {
            $bdd->supprimerSourceRevenu($sourceId);
        }
    }



    // Supprimer un frais
    if (isset($_POST['supprimer_frais'])) {
        $index = filter_input(INPUT_POST, 'supprimer_frais', FILTER_SANITIZE_NUMBER_INT);
        if (isset($_SESSION['frais_deductibles'][$index])) {
            unset($_SESSION['frais_deductibles'][$index]);
            $_SESSION['frais_deductibles'] = array_values($_SESSION['frais_deductibles']);
        }
    }

    // Modifier un frais (à adapter selon ton besoin exact)
    if (isset($_POST['modifier_frais'])) {
        // logiquement tu devrais avoir un champ pour entrer la nouvelle valeur
        // Ex: $_POST['nouveau_frais_modifié']
        // À compléter selon ton cas
    }

    // Valider taux
    if (isset($_POST['valider_taux'])) {
        $taux = filter_input(INPUT_POST, 'taux', FILTER_VALIDATE_FLOAT);
        if ($taux !== false && $taux >= 0 && $taux <= 100) {
            $_SESSION['taux_donation'] = $taux;
        }
    }

    // Rafraîchissement des données
    $sourcesRevenu = $bdd->getSourceRevenu($id);

    // Affichage
    //include 'vues/v_personnaliser.php';
    break;

}

$sourcesRevenu = $bdd->getSourceRevenu($id);
include 'vues/v_personnaliser.php';

?>