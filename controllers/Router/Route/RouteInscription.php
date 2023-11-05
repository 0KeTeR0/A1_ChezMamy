<?php

namespace App\ChezMamy\controllers\Router\Route;

use App\ChezMamy\controllers\UtilisateurController;
use App\ChezMamy\controllers\Router\Route;

/**
 * Classe RouteInscription
 * Route pour la page d'inscription
 */
class RouteInscription extends Route
{
    private UtilisateurController $controller;

    /**
     * Prépare l'affichage de la page
     * @param UtilisateurController $controller
     */
    public function __construct(UtilisateurController $controller)
    {
        parent::__construct();
        $this->controller = $controller;
    }

    /**
     * Affiche la page d'inscription
     * @param array $params Paramètres à passer à la page
     * @return void
     */
    protected function get(array $params = []): void
    {
        $this->controller->displayInscription();
    }

    /**
     * Exécute une action
     * @param array $params Paramètres à passer à l'exécution
     * @return void
     */
    protected function post(array $params = []): void
    {
        $this->controller->Inscription();
    }
}