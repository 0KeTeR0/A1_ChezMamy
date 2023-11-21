<?php

namespace App\ChezMamy\controllers\Router\Route;

use App\ChezMamy\controllers\OffresController;
use App\ChezMamy\controllers\Router\Route;
use App\ChezMamy\helpers\Message;

/**
 * Route pour la page pour gérer les offres posté
 * par le senior
 * @author Valentin Colindre
 */
class RouteGererDemandesSenior extends Route
{
    private OffresController $controller;

    /**
     * Prépare l'affichage de la page
     * @param OffresController $controller
     * @author Valentin Colindre
     */
    public function __construct(OffresController $controller)
    {
        parent::__construct();
        $this->controller = $controller;
    }

    /**
     * Affiche la page
     * @param array $params Paramètres à passer à la page
     * @return void
     * @author Valentin Colindre
     */
    protected function get(array $params = []): void
    {

        $this->controller->gererDemandesSenior();
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