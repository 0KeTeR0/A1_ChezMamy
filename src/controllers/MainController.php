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
     */
    public function Index(): void
    {
        // affichage de la vue
        $indexView = new View('Index');
        $indexView->generer([]);
    }

    public function Exception(?array $params = null): void
    {
        $notFoundView = new View('Exception');
        $notFoundView->generer($params);
    }
}