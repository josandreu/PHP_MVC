<?php

namespace App\model;

use App\core\Database;
use App\core\Session;
use App\libs\Helper;
use App\libs\Strings;
use PDO;

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

    // obtenemos el nº de preguntas
    public static function getOneAsObject($data) {
        $conn = Database::getInstance()->getDb();
        $query = $conn->prepare("SELECT * FROM pregunta WHERE slug = :slug");
        $query->bindValue(':slug', $data);
        $query->execute();
        return $query->fetch(); // obtenemos la siguiente fila completa, lo usamos para insertar los datos en un input
    }

    // obtenemos el nº de preguntas
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
        if (empty($data['asunto']) && empty($data['cuerpo'])) {
            Session::add('feedback_negative', "Error al editar, falta de completar el asunto");
            Session::add('feedback_negative', "Error al editar, falta de completar el cuerpo");
            return false;
        } else if (empty($data['cuerpo'])) {
            Session::add('feedback_negative', "Error al editar, falta de completar el cuerpo");
            return false;
        } else if (empty($data['slug'])) {
            Session::add('feedback_negative', "Error al editar, falta de completar el slug");
            return false;
        } else if (empty($data['asunto'])) {
            Session::add('feedback_negative', "Error al editar, falta de completar el asunto");
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

    public static function howManyAnswers($id) {
        $id = (int) $id; // forzamos a que sea un entero
        $sql = "SELECT COUNT(*) as num FROM respuesta WHERE id_pregunta = :id";
        $conn = Database::getInstance()->getDb();
        if($id) {
            $query = $conn->prepare($sql);
            $query->bindValue(':id', $id, \PDO::PARAM_INT);
            $query->execute();
            $answers = $query->fetch();
            return $answers->num;
        } else return false;
    }

    public static function insertAnswer($slug, $data) {
        $conn = Database::getInstance()->getDb();
        // obtengo la pregunta a la que se desea responder
        $question = self::getOneAsObject($slug);
        if(!$question){
            return false;
        }
        //valido la respuesta
        if(empty($data["answer"])){
            Session::add('feedback_negative', "No he recibido la respuesta");
            return false;
        }
        if(strlen($data["answer"]) < 10){
            Session::add('feedback_negative', "La respuesta es demasiado corta");
            Session::add('feedback_negative', "Respuestas válidas a partir de 10 caracteres");
            return false;
        }
        $sql = 'INSERT INTO respuesta (id_pregunta, id_usuario, respuesta) VALUES (:id_pregunta, :id_usuario, :respuesta)';
        $query = $conn->prepare($sql);
        $params = array(
            ':id_pregunta' => $question->id_pregunta,
            ':id_usuario' => Session::get('user_id'),
            ':respuesta' => $data['answer']
        );
        $query->execute($params);
        $count = $query->rowCount();
        if ($count == 1) {
            //$_SESSION["feedback_positive"][] = "Creado correctamente";
            return $conn->lastInsertId();
        }
        return false;
    }

    public static function getOnlyAnswers($questionId) {
        $conn = Database::getInstance()->getDb();
        $questionId = (int) $questionId;
        if($questionId) {
            $sql = "SELECT respuesta FROM respuesta WHERE id_pregunta = :questionId";
            //echo Helper::debugPDO($sql, array($questionId));
            $query = $conn->prepare($sql);
            $query->bindValue(':questionId', $questionId, PDO::PARAM_INT);
            $query->execute();
            return $answers = $query->fetchAll();
        } else {
            Session::add('feedback_negative', "No existen respuestas para esta pregunta");
            return false;
        }
    }

    public static function getAnswers($questionId) {
        $conn = Database::getInstance()->getDb();
        $questionId = (int) $questionId;
        if($questionId) {
            $sql = "SELECT id_respuesta, id_pregunta, id_usuario, respuesta FROM respuesta WHERE id_pregunta = :questionId";
            //echo Helper::debugPDO($sql, array($questionId));
            $query = $conn->prepare($sql);
            $query->bindValue(':questionId', $questionId, PDO::PARAM_INT);
            $query->execute();
            return $answers = $query->fetchAll();
        } else {
            Session::add('feedback_negative', "No existen respuestas para esta pregunta");
            return false;
        }
    }
}