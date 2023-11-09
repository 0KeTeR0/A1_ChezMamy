<?php

namespace App\ChezMamy\controllers\Router\Route;

use App\ChezMamy\controllers\MainController;
use App\ChezMamy\controllers\Router\Route;
use App\ChezMamy\helpers\Message;

/**
 * Classe RouteContact
 * Route pour la page de contact
 */
class RouteContact extends Route
{
    private MainController $controller;

    /**
     * Prépare l'affichage de la page
     * @param MainController $controller
     * @author Valentin Colindre
     */
    public function __construct(MainController $controller)
    {
        parent::__construct();
        $this->controller = $controller;
    }

    /**
     * Affiche la page de contact
     * @param array $params Paramètres à passer à la page
     * @return void
     * @author Valentin Colindre
     */
    protected function get(array $params = []): void
    {
        $this->controller->Contact();
    }

    /**
     * Exécute une action
     * @param array $params Paramètres à passer à l'exécution
     * @return void
     * @author Valentin Colindre, Romain Card
     */
    protected function post(array $params = []): void
    {
        try{
            $data=[
                "prenom"=>$this->getParam($params,"prenom", false),
                "nom"=>$this->getParam($params,"nom", false),
                "mail"=>$this->getParam($params,"mail", false),
                "sujet"=>$this->getParam($params,"sujet", false),
                "message"=>$this->getParam($params,"message", false)
            ];

            $this->controller->SendMails($data);
        }
        catch (\Exception $e){
            $this->controller->Contact(new Message($e->getMessage()));
        }
    }
}