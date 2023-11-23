<?php 

namespace BLibrary\Database\Connection;

use PDO;
use PDOException;

class DB 
{
    private static $instance = null;

    public static function connect()
    {
        if (is_null(self::$instance)) {
            self::$instance = self::init();
        } 

        return self::$instance;
    }

    private static function init()
    {
        try {
            $pdo = new PDO("mysql:host=".DB_HOST.";dbname=". DB_NAME, DB_USER, DB_PASSWORD, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);

            return $pdo;
        } catch (PDOException $e) {
            redirect(route("broken"));
        }
    }
}