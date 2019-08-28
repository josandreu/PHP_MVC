<?php
require_once 'lib/DBPDO.php';

class Usuario extends DBPDO
{
    public $table = 'usuarios';

    public $definition = array('nombre', 'email', 'password', 'edad');

    /*public function getAll($table = 'usuarios', $limit = 10) {
        return parent::getAll($table, $limit);
    }*/
    public function insert(array $params) {
        return parent::insert($this->validateParams($params));
    }

    private function validateParams($params) {
        // FALTA HACER validación de los parametros
        return $params;
    }
}