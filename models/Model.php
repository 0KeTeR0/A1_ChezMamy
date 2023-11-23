<?php

namespace App\ChezMamy\models;

use App\ChezMamy\config\Config;
use App\ChezMamy\models\DAO\DAO;
use PDO;
use PDOException;
use PDOStatement;


/**
 * Classe abstraite Model
 * Model général
 * @authors Romain Card, Valentin Colindre
 */
abstract class Model
{

    /**
     * Définit le DAO utilisé par le model
     * @return PDO le PDO utilisé par le DAO
     * @author Valentin Colindre
     */
    private function getDAO():PDO
    {
        return DAO::getDB();
    }

    /**
     * @param string $sql Requête SQL à exécuter
     * @param array|null $params Paramètres de la requête
     * @return PDOStatement|false Résultats de la requête
     * @author Romain Card
     */
    protected function execRequest(string $sql, ?array $params = null): PDOStatement|false
    {
        $res = false;

        if ($params === null) {
            $res = $this->getDAO()->query($sql); // requête sans paramètre
        }
        else {
            $res = $this->getDAO()->prepare($sql); // requête préparée avec des paramètres
            $res->execute($params);
        }

        return $res;
    }

    /**
     * Retourne le dernier ID de la dernière insertion fait avec
     * le PDO de la classe.
     * @return false|string faux ou l'id
     * @author Valentin Colindre
     */
    protected function getLastId():false|string{
        return $this->getDAO()->lastInsertId();
    }

}