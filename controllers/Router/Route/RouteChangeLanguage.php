<?php

namespace App\ChezMamy\controllers\Router\Route;

use App\ChezMamy\controllers\MainController;
use App\ChezMamy\controllers\Router\Route;
use Exception;

/**
 * Classe RouteChangeLanguage
 * Route pour changer de langage
 */
class RouteChangeLanguage extends Route
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
     * Affiche la page d'accueil après déconnexion
     * @param array $params Paramètres à passer à la page
     * @return void
     * @author Romain Card
     */
    protected function get(array $params = []): void
    {
        throw new Exception("La page demandée n'existe pas");
    }

    /**
     * Exécute une action
     * @param array $params Paramètres à passer à l'exécution
     * @return void
     * @author Romain Card
     */
    protected function post(array $params = []): void
    {
        $this->controller->changeLanguage($params);
    }
}