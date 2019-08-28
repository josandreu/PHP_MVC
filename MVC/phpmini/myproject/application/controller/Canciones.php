<?php


use App\core\Controller;

class Canciones extends Controller
{
    public function index() {
        // $titulo se utiliza para la etiqueta title del header, variable local
        // podemos acceder a ella desde el header porque está en el mismo ámbito de la función, ya
        // que estamos cargando el código de las vistas a través de los requires, es como si
        // el código estuviera dentro de esta función
        // esto no es lo recomendable, estamos cragando html dentro de un controlador
        $titulo = 'Canciones';
        require APP . 'view/_templates/header.php';
        require APP . 'view/canciones/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function listar() {
        $conn = \App\core\Database::getInstance()->getDb();
        $model = new \App\model\Model($conn);
        $canciones = $model->getAllSongs();
        // de esta forma, decimos qué vista ha de cargar
        // y pasamos en un array los datos necesarios que la vista espera
        $this->View->render('canciones/listar', array(
            'canciones' => $canciones,
            'titulo' => 'Listado de canciones'
        ));
    }

    public function ver($id = 0) {
        $id = (int) $id; // hacemos un casting a int, forzamos que sea un entero
        if ($id == 0) {
            // nos redirige
          header('location: /canciones/listar');
        } else {
            $cancion = $this->model->getSong($id);
            $this->View->render('canciones/ver', array(
                'cancion' => $cancion,
                'titulo' => $cancion->track
            ));
        }
    }
}