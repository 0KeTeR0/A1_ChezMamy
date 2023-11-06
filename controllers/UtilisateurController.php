<?php
namespace App\ChezMamy\controllers;

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
     * @author Romain Card
     */
    public function displayInscription()
    {
        // affichage de la vue
        $inscriptionView = new View('Inscription');
        $inscriptionView->generer([]);
    }

    /**
     * Exécute l'inscription de l'utilisateur
     * @return void
     */
    public function Inscription(array $data): void
    {

    }
}