<?php

namespace App\ChezMamy\controllers\Router\Route;

use App\ChezMamy\controllers\MainController;
use App\ChezMamy\controllers\Router\Route;

/**
 * Classe RouteException
 * Route pour la page d'erreur
 */
class RouteException extends Route
{
    private MainController $controller;

    /**
     * Prépare l'affichage de la page
     * @param MainController $controller
     * @author Romain Card
     */
    public function __construct(MainController $controller)
    {
        parent::__construct();
        $this->controller = $controller;
    }

    /**
     * Affiche la page d'erreur
     * @param array $params Paramètres à passer à la page
     * @return void
     * @author Romain Card
     */
    protected function get(array $params = []): void
    {
        $this->controller->Exception($params);
    }

    /**
     * Exécute une action
     * @param array $params Paramètres à passer à l'exécution
     * @return void
     * @author Romain Card
     */
    protected function post(array $params = []): void
    {

    }
}