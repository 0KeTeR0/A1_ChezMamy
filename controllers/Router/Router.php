<?php

namespace App\ChezMamy\controllers\Router;

use App\ChezMamy\controllers\MainController;
use App\ChezMamy\controllers\Router\Route\RouteChangeLanguage;
use App\ChezMamy\controllers\Router\Route\RouteConnexion;
use App\ChezMamy\controllers\Router\Route\RouteContact;
use App\ChezMamy\controllers\Router\Route\RouteDeco;
use App\ChezMamy\controllers\Router\Route\RouteException;
use App\ChezMamy\controllers\Router\Route\RouteIndex;
use App\ChezMamy\controllers\Router\Route\RouteInscription;
use App\ChezMamy\controllers\UtilisateurController;

/**
 * Classe Router
 * Gère le routage
 */
class Router
{
    private array $routeList;
    private array $ctrlList;
    private string $action_key;

    /**
     * Initialise le routeur
     * @param string $name_of_action_key Nom de la clé dans le tableau GET ou POST qui contient le nom de l'action à effectuer
     * @author Romain Card
     */
    public function __construct(string $name_of_action_key = "action")
    {
        $this->createControllerList();
        $this->createRouteList();
        $this->action_key = $name_of_action_key;
    }

    /**
     * @author Romain Card
     */
    private function CreateControllerList(): void
    {
        $this->ctrlList = [
            "main" => new MainController(),
            "utilisateur" => new UtilisateurController()
        ];
    }

    /**
     * @author Romain Card
     */
    private function CreateRouteList(): void
    {
        $this->routeList = [
            "index" => new RouteIndex($this->ctrlList["main"]),
            "contact" => new RouteContact($this->ctrlList["main"]),
            "connexion" => new RouteConnexion($this->ctrlList["utilisateur"]),
            "inscription" => new RouteInscription($this->ctrlList["utilisateur"]),
            "changeLanguage" => new RouteChangeLanguage($this->ctrlList["main"]),
            "deco" => new RouteDeco($this->ctrlList["utilisateur"]),
            "exception" => new RouteException($this->ctrlList["main"])
        ];
    }

    /**
     * Exécute le routage
     * @param array $get Paramètres GET
     * @param array $post Paramètres POST
     * @return void
     * @author Romain Card
     */
    public function routing(array $get = [], array $post = []): void
    {
        $action = $get[$this->action_key] ?? $post[$this->action_key] ?? "index";
        try  {
            if(!isset($this->routeList[$action])) throw new \Exception("Action inconnue");
            if ($post === []) {
                $this->routeList[$action]->action($get);
            }
            else {
                $this->routeList[$action]->action($post, 'POST');
            }
        }
        catch (\Exception $e)
        {
            http_response_code(404);
            $get["error"] = $e->getMessage();
            $this->routeList["exception"]->action($get);
        }
    }
}