<?php

namespace App\ChezMamy\controllers\Router\Route;

use App\ChezMamy\controllers\UtilisateurController;
use App\ChezMamy\controllers\Router\Route;

/**
 * Classe RouteConnexion
 * Route pour la page de connexion
 */
class RouteConnexion extends Route
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
     * Affiche la page de connexion
     * @param array $params Paramètres à passer à la page
     * @return void
     * @author Romain Card
     */
    protected function get(array $params = []): void
    {
        $this->controller->displayConnexion();
    }

    /**
     * Exécute une action
     * @param array $params Paramètres à passer à l'exécution
     * @return void
     * @author Romain Card
     */
    protected function post(array $params = []): void
    {
        try {
            $data = [
                "login" => $this->getParam($params, "login", false),
                "password" => $this->getParam($params, "password", false)
            ];

            $this->controller->Connexion($data);
        } catch (\Exception $e) {
            $this->controller->displayConnexion($e->getMessage(), $params['login']);
        }
    }
}