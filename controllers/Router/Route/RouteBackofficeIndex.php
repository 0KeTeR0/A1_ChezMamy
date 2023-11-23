<?php

namespace App\ChezMamy\controllers\Router\Route;

use App\ChezMamy\controllers\MainController;
use App\ChezMamy\controllers\Router\Route;

/**
 * Classe RouteBackofficeIndex
 * Route pour la page d'accueil du backoffice
 */
class RouteBackofficeIndex extends Route
{
    private MainController $controller;

    /**
     * Prépare l'affichage de la page
     * @param MainController $controller
     * @author Valentin Colindre
     */
    public function __construct(MainController $controller)
    {
        parent::__construct();
        $this->controller = $controller;
    }

    /**
     * Affiche la page d'accueil du backoffice
     * @param array $params Paramètres à passer à la page
     * @return void
     * @author Valentin Colindre
     */
    protected function get(array $params = []): void
    {
        $this->controller->BackofficeIndex();
    }

    /**
     * Exécute une action
     * @param array $params Paramètres à passer à l'exécution
     * @return void
     * @author Valentin Colindre
     */
    protected function post(array $params = []): void
    {

    }
}