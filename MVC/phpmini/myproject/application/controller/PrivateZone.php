<?php

use App\core\Auth;
use App\core\Controller;
use App\core\Session;

class PrivateZone extends Controller
{
    // queremos que solo se pueda acceder a esta zona, si el user está logueado

    /**
     * PrivateZone constructor.
     * Si quisiéramos hacer privada cualquier otra página, bastaría con añadir esto al constructor del conntrolador de la página
     * cambiando /privateZone por la ruta de la página en concreto
     */
    public function __construct() {
        parent::__construct();
        Session::set('origen', '/privateZone');
        Auth::checkAuthentication();
    }

    public function index() {
        // mostramos página de acceso privado, ya hemos comprobado en el constructor si el user está logueado
        echo $this->View->render('privateZone/index');
    }
}