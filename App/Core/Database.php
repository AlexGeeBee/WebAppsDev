<?php

namespace App\Core;

use PDO;

class Database {
    private static ?PDO $connection = null;

    public static function getConnection(): PDO {

        if (self::$connection != null) {
            return self::$connection;
        }

        $host = 'localhost';
        $port = '3306';
        $login = 'root';
        $password = '';
        $db_name = 'Beauty_Salon';

        self::$connection = new PDO (
            "mysql:host={$host};port={$port};dbname={$db_name}",
            $login,
            $password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        );
        return self::$connection;

    }
}

?>