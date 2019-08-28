<?php

class Persona {

    private $nombre = 'Shiribiri';

    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function presentate() {
         echo "Hola $this->nombre, presentate!", PHP_EOL;
     }
}

$persona = new Persona();
// $persona es una referencia a un objeto de la clase Persona
$persona->presentate(); // coge el valor asignado por defecto
$persona->setNombre('Salomón el cabrón'); // cambiamos el valor de nombre
$persona->presentate();