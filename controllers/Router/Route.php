<?php

namespace App\ChezMamy\controllers\Router;

use Exception;

/**
 * Classe abstraite Route
 * Gère une route
 */
abstract class Route
{
    public function __construct()
    {
    }

    /**
     * @param array $params Paramètres à passer à la page
     * @param string $method Méthode HTTP à utiliser
     * @return void
     * @author Romain Card
     */
    public function action(array $params = [], string $method = 'GET'): void
    {
        if ($method === 'GET') $this->get($params);
        else $this->post($params);
    }

    /**
     * @param array $array Tableau contenant les paramètres
     * @param string $paramName Nom du paramètre à récupérer
     * @param bool $canBeEmpty Indique si le paramètre peut être vide
     * @return mixed
     * @throws Exception Si le paramètre est absent ou vide et qu'il ne peut pas l'être
     * @author Romain Card
     */
    protected function getParam(array $array, string $paramName, bool $canBeEmpty = true)
    {
        if (isset($array[$paramName])) {
            if(!$canBeEmpty && empty($array[$paramName]))
                throw new Exception("Paramètre '$paramName' vide");
            return $array[$paramName];
        }
        else
            throw new Exception("Paramètre '$paramName' absent");
    }

    abstract protected function get(array $params = []);

    abstract protected function post(array $params = []);
}