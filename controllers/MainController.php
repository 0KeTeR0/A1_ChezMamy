<?php
namespace App\ChezMamy\controllers;

use App\ChezMamy\Views\View;

/**
 * Classe MainController
 * Contrôleur principal
 */
class MainController
{
    /**
     * Affiche la page d'accueil
     * @return void
     * @author Romain Card
     */
    public function Index(): void
    {
        // affichage de la vue
        $indexView = new View('Index');
        $indexView->generer([]);
    }

    public function changeLanguage(array $params = []): void
    {
        $availableLanguages = ['fr', 'en'];

        if (isset($params['language']) && in_array($params['language'], $availableLanguages)) {
            $_SESSION['lang'] = $params['language'];
        }

        header("Location: {$params['action']}");
    }

    /**
     * Affiche la page d'exception
     * @param array|null $params Paramètres à passer à la page
     * @return void
     * @author Romain Card
     */
    public function Exception(?array $params = null): void
    {
        $notFoundView = new View('Exception');
        $notFoundView->generer($params);
    }
}