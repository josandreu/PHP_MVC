<?php
namespace App\core;

class Auth
{

    public static function checkAuthentication() {
        Session::init();
        if (!Session::userIsLoggedIn()) {
            session_destroy();
            Session::init();
            Session::set('origen', $_SERVER['REQUEST_URI']); // para saber de qué página viene el usuario
            header('location: /login');
            exit();
        }
    }
}