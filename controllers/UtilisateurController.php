<?php
namespace App\ChezMamy\controllers;

use App\ChezMamy\helpers\Message;
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
    public function displayConnexion(): void
    {
        // affichage de la vue
        $connexionView = new View('Connexion');
        $connexionView->generer([]);
    }

    /**
     * Exécute la connexion de l'utilisateur
     * @return void
     * @author Romain Card
     */
    public function Connexion(array $data): void
    {

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