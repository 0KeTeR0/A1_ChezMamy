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
     * @author Valentin Colindre
     */
    protected function post(array $params = []): void
    {
        $error=null;
        try{
            $data=[
                "prenom"=>$this->getParam($params,"prenom"),
                "nom"=>$this->getParam($params,"nom"),
                "mail"=>$this->getParam($params,"mail"),
                "message"=>$this->getParam($params,"message")
            ];
        }
        catch (\Exception $e){
            $error=$e->getMessage();
        }
        if($error!=null) $this->controller->Contact(new Message($error));
        else $this->controller->SendMails($data);
    }
}