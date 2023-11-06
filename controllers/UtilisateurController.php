<?php
namespace App\ChezMamy\controllers;

use App\ChezMamy\helpers\Message;
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
     */
    public function Inscription(array $data): void
    {

    }
}