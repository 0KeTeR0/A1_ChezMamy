<?php

namespace App\ChezMamy\controllers\Router\Route;

use App\ChezMamy\controllers\UtilisateurController;
use App\ChezMamy\controllers\Router\Route;

/**
 * Classe RouteDeco
 * Route pour la déconnexion
 */
class RouteDeco extends Route
{
    private UtilisateurController $controller;

    /**
     * Prépare l'affichage de la page
     * @param UtilisateurController $controller
     * @author Romain Card
     */
    public function __construct(UtilisateurController $controller)
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
        $this->controller->Deco();
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