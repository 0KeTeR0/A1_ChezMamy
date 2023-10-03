<?php
namespace App\Chezmamy\Lib;

/**
 * Class DatabaseConnection
 * @package App\ChezMamy\Lib\Database
 * @brief This class is a singleton that provides a PDO connection to the database
 * @author Romain Card
 */
class DatabaseConnection
{
    private static ?\PDO $connection = null;

    private function __construct() {}

    public static function GetConnection(): \PDO
    {
        if(self::$connection == null) self::$connection = new \PDO('mysql:host=SRV-IQ-SQL;dbname="ChezMamy";charset=utf8', 'rc212120', 'rc212120noob');
        return self::$connection;
    }
}