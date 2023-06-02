<?php

namespace app\Database;

use PDO;
use PDOException;

class Connection
{
    public static function connect()
    {
        $host = $_ENV['HOST'];
        $database = $_ENV['DATABASE'];
        $username = $_ENV['USERNAME'];
        $password = $_ENV['PASSWORD'];
        $charset = $_ENV['CHARSET'];

        try {
            $conn = new PDO("mysql:host=" . $host . ";dbname=" . $database . ";charset=" . $charset, $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $conn;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
