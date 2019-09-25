<?php


use App\core\Controller;
use App\core\Session;
use App\model\LoginModel;

class Login extends Controller
{
    public function index() {
        echo $this->View->render('login/index');
    }

    // recibimos datos del formulario
    public function doLogin() {
        if (LoginModel::doLogin($_POST)) {
            // origen se crea cuando se llama al método checkAuthentication de la clase Auth
            if ($origen = Session::get('origen')) {
                Session::set('origen', null);
                header('location:' . $origen); // mandamos al usuario a la misma url desde donde intentó el login
                exit();
            } else echo $this->View->render('login/userIsLogged');
        } else {
            header('location: /login');
            exit();
        }
    }

    public function salir() {
        LoginModel::salir();
    }
}