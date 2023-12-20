<?php

namespace App\ChezMamy\controllers\Router\Route;

use App\ChezMamy\controllers\OffresController;
use App\ChezMamy\controllers\Router\Route;
use App\ChezMamy\helpers\Message;

class RouteBackofficeApprouverOffre extends Route
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
     * Affiche la page des offres
     * @param array $params Paramètres à passer à la page
     * @return void
     * @author Valentin Colindre
     */
    protected function get(array $params = []): void
    {
        $this->controller->displayApprouverOffre();
    }

    /**
     * Exécute une action
     * @param array $params Paramètres à passer à l'exécution
     * @return void
     * @author Valentin Colindre
     */
    protected function post(array $params = []): void
    {
        $message = null;


        if($this->controller->userIsStaff())
        {
            if(!empty($params['idOffreToApprove'])) $message = $this->controller->backofficeApprouver($this->getParam($params, "idOffreToApprove"));
            if(!empty($params['idOffreToDeny'])) $message = $this->controller->supprimerOffresStaff($this->getParam($params, "idOffreToDeny"));
            $this->controller->displayApprouverOffre($message);
        }

    }

}