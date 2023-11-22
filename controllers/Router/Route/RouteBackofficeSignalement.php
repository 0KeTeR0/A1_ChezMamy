<?php

namespace App\ChezMamy\controllers\Router\Route;

use App\ChezMamy\controllers\OffresController;
use App\ChezMamy\controllers\Router\Route;

class RouteBackofficeSignalement extends Route
{
    private OffresController $controller;

    /**
     * Prépare l'affichage de la page
     * @param OffresController $controller
     * @author Louis Demeocq
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
     * @author Louis Demeocq
     */
    protected function get(array $params = []): void
    {
        $this->controller->displaySignalement();
    }

    /**
     * Exécute une action
     * @param array $params Paramètres à passer à l'exécution
     * @return void
     * @author Louis Demeocq
     */
    protected function post(array $params = []): void
    {
        $message = null;

        if(!isset($params["searchPost"])) $params["searchPost"] = "";

        $data['searchPost'] = $this->getParam($params, "searchPost");

        if(!empty($params['idReportToDelete'])) $message = $this->controller->supprimerSignalement(["idReportToDelete" => $this->getParam($params, "idReportToDelete")]);
        if(!empty($params['idOffreToDelete'])) $message = $this->controller->supprimerOffres(["idOffreToDelete" => $this->getParam($params, "idOffreToDelete")]);
        $this->controller->chercherOffres($data, $message);
    }

}