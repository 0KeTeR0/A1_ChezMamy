<?php

namespace App\ChezMamy\models;

use App\ChezMamy\config\Config;
use PDO;
use PDOException;
use PDOStatement;


/**
 * Classe abstraite Model
 * Model général
 */
abstract class Model
{
    private ?PDO $db = null;

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
            $res = $this->getDB()->query($sql); // requête sans paramètre
        }
        else {
            $res = $this->getDB()->prepare($sql); // requête préparée avec des paramètres
            $res->execute($params);
        }

        return $res;
    }

    /**
     * Retourne le dernier ID de la dernière insertion fait avec
     * le PDO de la classe.
     * @author Valentin Colindre
     * @return false|string faux ou l'id
     */
    protected function getLastId():false|string{
        return $this->getDB()->lastInsertId();
    }

    /**
     * Crée et/ou retourne la connexion à la base de données
     * @return PDO
     * @author Romain Card
     */
    private function getDB(): PDO
    {
        if ($this->db === null) {
            try {
                // récupération des paramètres de configuration BD
                $config = Config::getInstance();
                $this->db = new PDO($config->getDsn(), $config->getUser(), $config->getPass()); // connexion locale
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (PDOException $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }

        return $this->db;
    }
}