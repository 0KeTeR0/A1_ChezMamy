<?php
namespace App\ChezMamy\controllers;

use App\ChezMamy\helpers\Message;
use App\ChezMamy\models\ComptesEtudiantsManager;
use App\ChezMamy\models\ComptesSeniorsManager;
use App\ChezMamy\models\ConnaissancesAssociationManager;
use App\ChezMamy\models\InfoUtilisateursManager;
use App\ChezMamy\models\TokensManager;
use App\ChezMamy\models\UtilisateurManager;
use App\ChezMamy\Views\View;

/**
 * Classe UtilisateurController
 * Contrôleur des utilisateurs
 */
class UtilisateurController
{
    /**
     * Affiche la page de connexion
     * @return void
     * @author Romain Card
     */
    public function displayConnexion(?string $message = null, ?string $login = null): void
    {
        if ($message !== null) $message = new Message($message, "Erreur de connexion", "danger");

        // affichage de la vue
        $connexionView = new View('Connexion');
        $connexionView->generer(["message" => $message ?? null, "login" => $login ?? null]);
    }

    /**
     * Exécute la connexion de l'utilisateur
     * @return void
     * @author Romain Card
     */
    public function Connexion(array $data): void
    {
        // Manager de l'utilisateur
        $utilisateurManager = new UtilisateurManager();
        $res = $utilisateurManager->checkLogin($data["login"], $data["password"]);

        if (!$res['success']) throw new \Exception($res['message']);

        // Création du token de connexion
        $tokensManager = new TokensManager();
        $token = $tokensManager->createToken($res['utilisateur']->getIdUtilisateur());

        // Connexion
        $_SESSION['auth_token'] = $token;

        // Redirection
        header('Location: accueil');
    }

    /**
     * Affiche la page d'inscription
     * @return void
     * @author Valentin Colindre
     */
    public function displayInscription(?string $message = null)
    {
        if ($message !== null) $message = new Message($message, "Erreur d'inscription", "danger");
        $connaissancesAssociation = new ConnaissancesAssociationManager();
        // affichage de la vue
        $inscriptionView = new View('Inscription');
        $inscriptionView->generer(["message" => $message ?? null, "option_connaissances" => $connaissancesAssociation->getAll()]);
    }

    /**
     * Exécute l'inscription de l'utilisateur
     * @return void
     * @author Valentin Colindre
     */
    public function Inscription(array $data): void
    {
        //On crée un nouvel Utilisateur
        $UManager = new UtilisateurManager();

        if($UManager->creationUtilisateur($data["login"],$data["password"],1)){

            //On ajoute son id à l'array de donnée
            $data["idUtilisateur"]= $UManager->getByLogin($data["login"])->getIdUtilisateur();
            //Puis on crée un nouvel InfoUtilisateurs à partir de l'id de l'Utilisateur
            // et les données de Data
            $IUManager = new InfoUtilisateursManager();

            $IUManager->creationInfoUtilisateur($data);
            //Si c'est un compte étudiant, on crée aussi un CompteEtudiant à partir de data dans la BDD
            if($this->$data["typeCompte"]=="0"){
                $CompteManager = new ComptesEtudiantsManager();

                $CompteManager->creationCompteEtudiant($data);
            }//Sinon on crée un CompteSenior dans la BDD
            else{
                $CompteManager = new ComptesSeniorsManager();

                $CompteManager->creationCompteSenior($data);
            }


        }//Sinon on affiche que le compte existe déjà
        else{
            $this->displayInscription("Login déjà utilisé");
        }

    }
}