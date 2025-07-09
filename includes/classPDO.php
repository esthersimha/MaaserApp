<?php
class PdoMaaserApp
{
    //initialise les attributrs en privés
    private static $serveur = 'mysql:host=localhost';
    private static $bdd = 'dbname=maaserapp';
    private static $user = 'root';
    private static $mdp = '';
    private static $monPdo;
    private static $monPdoMaaserApp = null;

    /**
     * Constructeur privé, crée l'instance de PDO qui sera sollicitée
     * pour toutes les méthodes de la classe
     */
    private function __construct()
    {
        PdoMaaserApp::$monPdo = new PDO(
            PdoMaaserApp::$serveur . ';' . PdoMaaserApp::$bdd,
            PdoMaaserApp::$user,
            PdoMaaserApp::$mdp
        );
        PdoMaaserApp::$monPdo->query('SET CHARACTER SET utf8');
    }

    /**
     * Méthode destructeur appelée dès qu'il n'y a plus de référence sur un
     * objet donné, ou dans n'importe quel ordre pendant la séquence d'arrêt.
     */
    public function __destruct()
    {
        PdoMaaserApp::$monPdo = null;
    }

    /**
     * Fonction statique qui crée l'unique instance de la classe
     * Appel : $instancePdoMaaserApp = PdoMaaserApp::getPdoMaaserApp();
     *
     * @return l'unique objet de la classe PdoMaaserApp
     */
    public static function getPdoMaaserApp()
    {
        if (PdoMaaserApp::$monPdoMaaserApp == null) {
            PdoMaaserApp::$monPdoMaaserApp = new PdoMaaserApp();
        }
        return PdoMaaserApp::$monPdoMaaserApp;
    }

    public function creerNouvelUtilisateur($nom,$prenom,$email,$mdpHach){
        $requetePrepare=PdoMaaserApp::$monPdo->prepare(
            'INSERT INTO utilisateurs(nom,prenom,email,mdp) '
            . 'VALUES (:unNom, :unPrenom, :unEmail, :unMdp)'
        );

        $requetePrepare->bindParam(':unNom',$nom,PDO::PARAM_STR);
        $requetePrepare->bindParam(':unPrenom',$prenom,PDO::PARAM_STR);
        $requetePrepare->bindParam(':unEmail',$email,PDO::PARAM_STR);
        $requetePrepare->bindParam(':unMdp',$mdpHach,PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->rowCount()>0;
    }

    public function verifierConnexion($email){
        $requetePrepare=PdoMaaserApp::$monPdo->prepare(
           'SELECT * FROM utilisateurs WHERE email = :unEmail'
        );
        $requetePrepare->bindParam(':unEmail',$email,PDO::PARAM_STR);
        $requetePrepare->execute();
        $resultat = $requetePrepare-> fetch(PDO::FETCH_ASSOC);
        return $resultat;
    }

    public function verifEmailExist($email){
         $requetePrepare=PdoMaaserApp::$monPdo->prepare(
            'SELECT COUNT(*) FROM utilisateurs WHERE email = :unEmail'
        );
        $requetePrepare->bindParam(':unEmail',$email,PDO::PARAM_STR);
        $requetePrepare->execute();
        $resultat = $requetePrepare->fetchColumn();
        return $resultat >0;
    }

     public function verifSourceRevenuExist($id){
         $requetePrepare=PdoMaaserApp::$monPdo->prepare(
            'SELECT COUNT(*) FROM sources_revenu WHERE utilisateur_id = :unId'
        );
        $requetePrepare->bindParam(':unId',$id,PDO::PARAM_INT);
        $requetePrepare->execute();
        $resultat = $requetePrepare->fetchColumn();
        return $resultat >0;
    }

    public function getSourceRevenu($id){
       $requetePrepare=PdoMaaserApp::$monPdo->prepare(
           'SELECT * FROM sources_revenu WHERE utilisateur_id = :unId'
        );
        $requetePrepare->bindParam(':unId', $id, PDO::PARAM_INT);
        $requetePrepare->execute();
        $resultat = $requetePrepare->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }

      public function ajouterSourceRevenu($id, $newSourceRevenu){
        $requetePrepare=PdoMaaserApp::$monPdo->prepare(
            'INSERT INTO sources_revenu(utilisateur_id, libelle) '
            . 'VALUES (:unId, :unLibelle)'
        );
        $requetePrepare->bindParam(':unId',$id,PDO::PARAM_INT);
        $requetePrepare->bindParam(':unLibelle',$newSourceRevenu,PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->rowCount()>0;
    }

    public function supprimerSourceRevenu($sourceId){
        $requetePrepare=PdoMaaserApp::$monPdo->prepare(
            'DELETE FROM sources_revenu WHERE id = :sourceId'
        );
        $requetePrepare->bindParam(':sourceId', $sourceId ,PDO::PARAM_INT);
        $requetePrepare->execute();
        return $requetePrepare->rowCount()>0;
    }

    public function modifierSourceRevenu($sourceId, $newLibelle){
        $requetePrepare=PdoMaaserApp::$monPdo->prepare(
            'UPDATE sources_revenu SET libelle = :unLibelle WHERE id = :sourceId'
        );
        $requetePrepare->bindParam(':sourceId',$sourceId,PDO::PARAM_INT);
        $requetePrepare->bindParam(':unLibelle',$newLibelle,PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->rowCount()>0;
    }

}

?>