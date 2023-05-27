<?php

namespace app\Database;

use PDO;
use PDOException;

class Connection
{
    private const HOST = "localhost";
    private const DATABASE = "reservation_system";
    private const USERNAME = "root";
    private const PASSWORD = "";
    private const CHARSET = "utf8";

    public static function connect()
    {
        try {
            $conn = new PDO("mysql:host=" . self::HOST . ";dbname=" . self::DATABASE. ";charset=". self::CHARSET, self::USERNAME, self::PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $conn;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
