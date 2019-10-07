<?php

//namespace App\controller;

use App\core\Auth;
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
        Auth::checkAuthentication(); // solo podrán insertar preguntas los usuarios logueados
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
                    exit();
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
                    exit();
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

    public function howManyAnswers($id = 0) {
        $number = QuestionsModel::howManyAnswers($id);
        echo $this->View->render('questions/howManyAnswers', array('number' => $number));
    }

    public function sendAnswer($slug = '') {
        Auth::checkAuthentication(); // solo podrán insertar respuestas los usuarios logueados
        // si no recibimos datos GET (a través de la URL) mostramos el formulario
        if (!$_POST) {
            $question = QuestionsModel::getOneAsObject($slug); // para mostrar los datos de la pregunta y pasarlos a la vista
            // $question = QuestionsModel::getOneAsArray($slug)[0]; // sería lo mismo que arriba, pero accedemos a la posición 0 al ser un array
            echo $this->View->render('questions/formAnswer', array('question' => $question)); // mostramos el formulario de respuesta
        } else {
            $res = QuestionsModel::insertAnswer($slug, $_POST);
            echo $this->View->render('questions/answerInserted', array('answer' => $res)); // pasamos a la vista el resultado de insertar una nueva respuesta
        }
    }

    public function sendAnswerJSON($slug = '') {
        Auth::checkAuthentication(); // solo podrán insertar respuestas los usuarios logueados
        $question = QuestionsModel::getOneAsObject($slug); // para mostrar los datos de la pregunta y pasarlos a la vista
        // si no recibimos datos GET (a través de la URL) mostramos el formulario
        if (!$_POST) {
            $numberOfAnswers = QuestionsModel::howManyAnswers($question->id_pregunta); // nº de respuestas asociadas a la pregunta
            // mostramos el formulario de respuesta
            echo $this->View->render('questions/formAnswerJSON', array(
                'question' => $question,
                'numberOfAnswers' => $numberOfAnswers
                ));
        } else {
            $res = QuestionsModel::insertAnswer($slug, $_POST);
            $number = QuestionsModel::howManyAnswers($question->id_pregunta);
            // pasamos a la vista el resultado de insertar una nueva respuesta, esta vista es un JSON
            echo $this->View->render('questions/answerInsertedJSON', array(
                'answer' => $res,
                'number' => $number
                ));
        }
    }

    public function getAnswersJSON($questionId) {
        $answers = QuestionsModel::getOnlyAnswers($questionId);
        echo $this->View->render('questions/getAnswersJSON', array('answers' => $answers));
    }

    public function getAnswersJSONHandlebars($questionId) {
        $answers = QuestionsModel::getAnswers($questionId);
        echo $this->View->render('questions/getAnswersJSONHbar', array('answers' => $answers));
    }


}