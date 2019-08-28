<?php

namespace App\core;

use PDO;
use PDOException;

class Database

////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// ESTA CLASE TIENE PATRÓN SINGLETON
/// Open the database connection with the credentials from application/config/config.php
////////////////////////////////////////////////////////////////////////////////////////////////////////////

{
    private static $instancia = null;
    private $db = null;

    private function __construct() {
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        // generate a database connection, using the PDO connector
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
        try {
            $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
        } catch (PDOException $exception) {
            exit("No tenemos acceso a la base de datos: $exception");
        }
    }

    public static function getInstance() {
        if (is_null(self::$instancia)) {
            self::$instancia = new Database();
        }
        return self::$instancia;
    }

    public function getDb() {
        return $this->db;
    }
}

// $conn = Database::getInstance()->getDb();