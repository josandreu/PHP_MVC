<?php
namespace App\core;

use App\model\Model;
use PDO;

class Controller
{
    /**
     * @var null Database Connection
     */
    // public $db = null; NO VAMOS A GESTIONAR LA BBDD A TRAVÉS DEL CONTROLADOR

    /**
     * @var null Model
     */
    // public $model = null; NO VA A HABER UN SÓLO MODELO, POR LO TANTO FUERA DEL CONTROLADOR

    public $View = null;

    /**
     * Whenever controller is created, open a database connection too and load "the model".
     */
    function __construct()
    {
        // $this->openDatabaseConnection(); NO QUEREMOS INSTANCIAR LA BBDD DESDE AQUÍ, SINO DESDE LA CLASE Database.php
        // $this->loadModel(); TAMPOCO CARGAREMOS EL MODELO DESDE AQUÍ

        // huge template
        // $this->View = new View(); // esto nos permite tener acceso a este clase desde cualquier controlador y poder cargar las vistas, ya que todos heredan de Controller

        // plates template
        $this->View = TemplatesFactory::templates(); // plates template
        Session::init(); // iniciamos una sesión a través de la clase Session
    }

    /**
     * Open the database connection with the credentials from application/config/config.php
     * LA BBDD LA GESTIONAMOS DESDE Database.php
     */
    /*private function openDatabaseConnection()
    {
        // set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        // "objects", which means all results will be objects, like this: $result->user_name !
        // For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
        // @see http://www.php.net/manual/en/pdostatement.fetch.php
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        // generate a database connection, using the PDO connector
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
    }*/


/*
    YA NO LO NECESITAMOS CARGAR DESDE AQUÍ GRACIAS AL AUTOLOAD DE COMPOSER
    public function loadModel()
    {
        require APP . 'model/model.php';
        // create new "model" (and pass the database connection)
        $this->model = new Model($this->db);
    }
*/
}
