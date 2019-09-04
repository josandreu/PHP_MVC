<?php

//namespace App\controller;

use App\core\Controller;
use App\model\QuestionsModel;

class Questions extends Controller
{
    // veremos el contenido de la tabla preguntas
    public function showQuestions() {
        $questions = QuestionsModel::getAll();

        echo $this->View->render('questions/showQuestions', array(
            'questions' => $questions
        ));
    }

    public function insert() {
        if (!$_POST) {
            // si no estamos recibiendo nada por POST ... que muestre el formulario
            // $this->View->render('questions/formQuestions');
            echo $this->View->render('questions/formQuestions');
        } else {
            // y si recibimos datos, los insertamos
            // pero primero, comprobación de $_POST, por si hubiera alguna manipulación en el formulario
            if (!isset($_POST['asunto']))
                $_POST['asunto'] = "";
            if (!isset($_POST['cuerpo']))
                $_POST['cuerpo'] = "";
            // guardamos en un array el contenido de $__POST
            $data = array(
                'asunto' => $_POST['asunto'],
                'cuerpo' => $_POST['cuerpo']
            );
            if (QuestionsModel::insert($data)) {
                // $this->View->render('questions/insertQuestions');
                echo $this->View->render('questions/insertQuestions');
            } else {
                echo $this->View->render('questions/formQuestions', array(
                    'errores' => array('Error al insertar'),
                    'data' => $_POST // pasamos el contenido del formulario
                    ));
            }
        }
    }

    // IMPORTANTE!!!!
    // EL PARÁMETRO QUE RECIBE ESTA FUNCIÓN VIENE DE LA URL
    // 192.168.33.44/questions/edit/A_PARTIR_DE_AQUI_ES_LO_QUE_RECIBE?slugURL=ESTO_ES_$_GET
    public function edit($slug = "") {
        $resultAsArray = QuestionsModel::getOneAsArray($slug); // para mostrar los datos de la pregunta en el jumbotron
        // si no entramos a través de la opción de editar una pregunta (es decir, escribimos directamente la url)
        // ya que estamos pasando en el link -> ?slugURL=<?= $question->slug ?
        if (!isset($_GET['slugURL'])) {
            $this->showQuestions();
        } else {
            // si no recibo datos del formulario
            if (!$_POST) {
                // d($slug); // 192.168.33.44/questions/edit/$slug
                // d($_GET['slugURL']); // 192.168.33.44/questions/edit/$slug?slugURL=...
                $dato = QuestionsModel::getOneAsObject($slug); // para mostrarlo en los input
                if ($dato) {
                    //echo $this->View->render('layout');
                    echo $this->View->render('questions/formQuestions', array(
                        'dato' => get_object_vars($dato), // para convertirlo en un array asociativo que contiene las propiedades del objeto
                        'resultAsArray' => $resultAsArray,
                        'accion' => 'editar'
                    ));
                } else {
                    // si no existe la pregunta con el slug de la url...
                    header('location: home/index');
                }
            } else {
                // si recibimos datos del formulario (estamos ya editando), guardamos los datos recibidos del formulario en un array
                $dato = array(
                    'asunto' => (isset($_POST['asunto'])) ? $_POST['asunto'] : "",
                    'cuerpo' => (isset($_POST['cuerpo'])) ? $_POST['cuerpo'] : "",
                    'slug' => $slug // lo recibimos mediante el parámetro de la url -> 192.168.33.44/questions/edit/$slug
                );
                // mando los datos al modelo para actualizarlos
                if (QuestionsModel::edit($dato)) {
                    // $this->View->render('questions/editQuestions');
                    header('location: /questions/showQuestions');
                } else {
                    echo $this->View->render('questions/formQuestions', array(
                        // ESTO HABRÍA QUE CAMPBIARLO / DEPURARLO
                        'errores' => array('Error al editar'),
                        'dato' => $_POST,
                        'resultAsArray' => $resultAsArray,
                        'accion' => 'editar'
                    ));
                }
            }

        }
    }
}