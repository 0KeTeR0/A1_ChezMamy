<?php

namespace App\ChezMamy\controllers\Router\Route;

use App\ChezMamy\controllers\MainController;
use App\ChezMamy\controllers\Router\Route;
use App\ChezMamy\controllers\UtilisateurController;
use App\ChezMamy\helpers\Message;

/**
 * Classe RouteBackofficeGestionCompte
 * Route pour la page de gestion des comptes du backoffice
 */
class RouteBackofficeGestionCompte extends Route
{
    private UtilisateurController $controller;

    /**
     * Prépare l'affichage de la page
     * @param MainController $controller
     * @author Valentin Colindre
     */
    public function __construct(UtilisateurController $controller)
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
        $this->controller->BackofficeGestionCompte();
    }

    /**
     * Exécute une action
     * @param array $params Paramètres à passer à l'exécution
     * @return void
     * @author Valentin Colindre
     */
    protected function post(array $params = []): void
    {
        $message =null;

        if($this->controller->isStaff()){
            try {
                if (!empty($params['idUserABloquer']))  $message = $this->controller->bloqueCompte($this->getParam($params, "idUserABloquer"));
                if (!empty($params['idUserADebloquer'])) $message = $this->controller->debloqueCompte($this->getParam($params, "idUserADebloquer"));
            }
            catch (\Exception $e){
                $message = new Message($e->getMessage());
            }
        }
        else header('Location: accueil');

        $this->controller->BackofficeGestionCompte($message);
    }
}