<?php

namespace App\model;

use App\core\Database;
use App\core\Session;
use App\libs\Strings;

class QuestionsModel
{
/*
    private static $conn;

    public function __construct() {
        self::$conn = Database::getInstance()->getDb();
    }
*/


    public static function getAll() {
        $conn = Database::getInstance()->getDb();
        $query = $conn->prepare("SELECT * FROM pregunta");
        $query->execute();
        return $query->fetchAll(); // DEVOLVEMOS TODOS LOS REGISTROS ENCONTRADOS
    }

    public static function getOneAsObject($data) {
        $conn = Database::getInstance()->getDb();
        $query = $conn->prepare("SELECT * FROM pregunta WHERE slug = :slug");
        $query->bindValue(':slug', $data);
        $query->execute();
        return $query->fetch(); // obtenemos la siguiente fila completa, lo usamos para insertar los datos en un input
    }

    public static function getOneAsArray($data) {
        $conn = Database::getInstance()->getDb();
        $query = $conn->prepare("SELECT * FROM pregunta WHERE slug = :slug");
        $query->bindValue(':slug', $data);
        $query->execute();
        return $query->fetchAll(); // obtenemos un array
    }

    public static function insert($data) {
        $conn = Database::getInstance()->getDb();
        // validamos los datos
        $errores_validacion = false;
        if ($data['asunto'] === " " || empty($data['asunto']) ) {
            Session::add('feedback_negative', 'No he recibido el campo "asunto" de la pregunta');
            $errores_validacion = true;
        }
        if ($data['cuerpo'] === " " || empty($data['cuerpo'])) {
            Session::add('feedback_negative', 'No he recibido el campo "cuerpo" de la pregunta');
            $errores_validacion = true;
        }
        if ($errores_validacion)  {
            return false;
        }

        $slug = Strings::createSlug($data['asunto']); // creamos el contenido del slug a partir de la funcion creada en la clase Strings.php
        $params = array(
            ':asunto' => $data['asunto'],
            ':cuerpo' => $data['cuerpo'],
            ':slug' => $slug
        );
        $query = $conn->prepare("INSERT INTO pregunta (asunto, cuerpo, slug) VALUES (:asunto, :cuerpo, :slug)");
        $query->execute($params);

        $numOfInserts = $query->rowCount();
        if ($numOfInserts == 1 ) {
            return $conn->lastInsertId();
        }
        return false;
    }

    public static function edit($data) {
        $conn = Database::getInstance()->getDb();
        if (empty($data['asunto']) || empty($data['cuerpo']) || empty($data['slug'])) {
            Session::add('feedback_negative', "Error al editar, falta de completar algún campo");
            return false;
        } else {
            $sql = "UPDATE pregunta SET asunto = :asunto, cuerpo = :cuerpo WHERE slug = :slug";
            $query = $conn->prepare($sql);
            $params = array(
                ':asunto' => $data['asunto'],
                ':cuerpo' => $data['cuerpo'],
                ':slug' => $data['slug']
            );
            $query->execute($params);

            $numOfEdits = $query->rowCount();
            if ($numOfEdits == 1 ) {
                Session::add('feedback_positive', 'Editado con éxito, gracias!!');
                return true;
            }
            // no se ha actualizado nada
            Session::add('feedback_negative', 'No se ha actualizado nada.');
            return false;
        }
    }
}