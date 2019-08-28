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

    public function templates() {
        if (!self::$templates) {
            // la ruta es 'view/plates' simplemente por diferenciarlo de las plantillas antiguas
            // lo ideal sería que la ruta fuera '/view'
            self::$templates = new Engine(APP . 'view/plates');
        }
        return self::$templates;
    }
}