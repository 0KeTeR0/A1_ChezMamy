<?php
namespace App\ChezMamy\controllers;

use App\ChezMamy\helpers\Message;
use App\ChezMamy\models\ComptesEtudiantsManager;
use App\ChezMamy\models\ComptesSeniorsManager;
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
        // affichage de la vue
        $inscriptionView = new View('Inscription');
        $inscriptionView->generer(["message" => $message ?? null]);
    }

    /**
     * Exécute l'inscription de l'utilisateur
     * @return void
     * @author Valentin Colindre
     */
    public function Inscription(array $data): void
    {

        $UManager = new UtilisateurManager();

        if($UManager->creationUtilisateur($data["login"],$data["password"],1)){

            $data["idUtilisateur"]= $UManager->getByLogin($data["login"])->getIdUtilisateur();

            $IUManager = new InfoUtilisateursManager();

            $IUManager->creationInfoUtilisateur($data);

            if($this->$data["typeCompte"]=="0"){
                $CompteManager = new ComptesEtudiantsManager();

                $CompteManager->creationCompteEtudiant($data);
            }
            else{
                $CompteManager = new ComptesSeniorsManager();

                $CompteManager->creationCompteSenior($data);
            }


        }
        else{
            $this->displayInscription("Login déjà utilisé");
        }

    }
}