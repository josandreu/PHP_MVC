<?php


namespace App\model;


use App\core\Database;
use App\core\Session;

class LoginModel
{
    // $datos son los valores enviados por POST del formulario
    public static function doLogin($datos) {
        // VALIDACIONES DE LOS DATOS
        // si el usuario accede a login/dologin directamente...
        if (!$datos) {
            Session::add('feedback_negative', 'No has accedido desde la página de login');
            return false;
        }
        // añadimos variable de sesion
        if (empty($datos['email'])) {
            Session::add('feedback_negative', 'No tengo datos de email');
        }
        // añadimos variable de sesion
        if (empty($datos['pass'])) {
            Session::add('feedback_negative', 'No tengo datos de contraseña');
        }
        // si existe la variable de sesión...
        if (Session::get('feedback_negative')) {
            return false;
        }
        // comprobamos que el email es válido
        $datos['email'] = trim($datos['email']);
        if (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
            Session::add('feedback_negative', 'El email no es válido');
        }
        // contraseña
        if (strlen($datos['pass']) < 4) {
            Session::add('feedback_negative', 'La contraseña debe de tener más de 4 caracteres');
        }
        if (Session::get('feedback_negative')) {
            return false;
        }

        // si llegamos hasta aquí es que los DATOS ESTÁN VALIDADOS
        $conn = Database::getInstance()->getDb();
        $user = $datos['email'];
        $pass = sha1($datos['pass']);
        $sql = "SELECT id_usuario, pass, nombre, id_perfil FROM usuario WHERE login = :email";
        $query = $conn->prepare($sql);
        $query->bindValue(':email', $user, \PDO::PARAM_STR);
        $query->execute();
        // hay que tener en cuenta que login es un campo que es UNIQUE en la tabla, por lo que como mucho devolverá 1 resultado
        $numOfUsers = $query->rowCount();
        if ($numOfUsers != 1) {
            Session::add('feedback_negative', 'No se encuentra ningún usuario con ese email');
            return false;
        }
        // si llega hasta aquí, el user existe, VALIDAMOS LA CLAVE
        $userReturned = $query->fetch();
        if ($userReturned->pass != $pass) {
            Session::add('feedback_negative', 'La contraseña no es correcta');
            return false;
        }
        // hasta aquí, user y pass son correctos, INICIAMOS LA SESIÓN para guardar estas variables de sesión
        Session::set('user_id', $userReturned->id_usuario);
        Session::set('user_name', $userReturned->nombre);
        Session::set('user_email', $user);
        Session::set('user_logged_in', true);
        // también podríamos guardar estos datos como un array o como un objeto ---> $user = new User($userReturned->nombre, ...)
        return true;
    }

    public static function salir() {
        Session::destroy();
        header('location: /login');
    }
}