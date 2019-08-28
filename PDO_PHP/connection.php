<?php


class Connection
{
    private const HOST = 'localhost';
    private const DBNAME = 'ejemplo';
    private const DNS = 'mysql:host='.self::HOST.';dbname='.self::DBNAME;
    private const LOGIN = 'root';
    private const PASS = 'lomu4229';

    public static function conn(array $options = null) : PDO {
        // ATTR_PERSISTENT -> para que no se cierre la conexión, tendremos que cerrarla manualmente
        // $options = array(PDO::ATTR_PERSISTENT => TRUE, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        try {
            $conn = new PDO(self::DNS, self::LOGIN, self::PASS, $options);
            echo "Conexión OK\n<br>";
        } catch(PDOException $exception) {
            print "¡Error!: " . $exception->getMessage() . "<br/>";
            die();
        }
        return $conn;
    }
}
