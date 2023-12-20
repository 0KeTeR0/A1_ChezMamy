<?php

namespace App\ChezMamy\models\DAO;

use App\ChezMamy\config\Config;
use PDO;
use PDOException;
use PDOStatement;


/**
 * Classe DAO
 * Accès bdd
 * @author Valentin Colindre
 */
class DAO
{
    static private ?PDO $db = null;


    /**
     * Crée et/ou retourne la connexion à la base de données
     * @return PDO
     * @authors Romain Card, Valentin Colindre
     */
    static public function getDB(): PDO
    {
        if (self::$db=== null) {
            try {
                // récupération des paramètres de configuration BD
                $config = Config::getInstance();
                self::$db = new PDO($config->getDsn(), $config->getUser(), $config->getPass()); // connexion locale
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (PDOException $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }

        return self::$db;
    }
}