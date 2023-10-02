<?php
namespace App\ChezMamy\Lib\Database;

class DatabaseConnection
{
    private static ?\PDO $connection = null;

    private function __construct() {}

    public static function GetConnection(): \PDO
    {
        if(self::$connection == null) self::$connection = new \PDO('mysql:host=SRV-IQ-SQL;charset=utf8', 'rc212120', 'rc212120noob');
        return self::$connection;
    }
}