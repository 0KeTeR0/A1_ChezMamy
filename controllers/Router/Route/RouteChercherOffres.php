<?php

namespace App\ChezMamy\controllers\Router\Route;

use App\ChezMamy\controllers\OffresController;
use App\ChezMamy\controllers\Router\Route;

/*
 * Route pour la page poster des offres
 * @author Romain Card
 */
class RouteChercherOffres extends Route
{
    private OffresController $controller;

    /**
     * Prépare l'affichage de la page
     * @param OffresController $controller
     * @author Romain Card
     */
    public function __construct(OffresController $controller)
    {
        parent::__construct();
        $this->controller = $controller;
    }

    /**
     * Affiche la page des offres
     * @param array $params Paramètres à passer à la page
     * @return void
     * @author Romain Card
     */
    protected function get(array $params = []): void
    {
        try {
            $data = [
                "searchPost" => $this->getParam($params, "searchPost")
            ];

            $this->controller->chercherOffres($data);
        } catch (\Exception $e) {
            $this->controller->chercherOffres(new Message("Erreur : " . $e->getMessage(), "Erreur"));
        }
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