<?php


namespace App\core;

use League\Plates\Engine;

/**
 * Class TemplatesFactory
 * @package App\core
 * Clase que se encarga de las tareas de inicilización del objeto Engine.php (plantillas plates)
 * Es una FACTORÍA, la utilizamos para instanciar un objeto Engine y configurarlo, así separamos la parte
 * de creación del objeto de la parte de utilización del objeto
 */

////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// ESTA CLASE TIENE PATRÓN SINGLETON
////////////////////////////////////////////////////////////////////////////////////////////////////////////

class TemplatesFactory
{
    private static $templates;

    public static function templates() {
        if (!self::$templates) {
            // la ruta es 'view/plates' simplemente por diferenciarlo de las plantillas antiguas
            // lo ideal sería que la ruta fuera '/view'
            self::$templates = new Engine(APP . 'view/plates');
            self::$templates->addData(['titulo' => 'Mini + plates']);
            // registramos esta función para básicamente limpiar las variables de sesión que almacenamos a través
            // de la clase Session, y la plantilla feedback.php
            self::$templates->registerFunction('delete_msg_feedback', function() {
                Session::set('feedback_positive', null);
                Session::set('feedback_negative', null);
            });
        }
        return self::$templates;
    }
}