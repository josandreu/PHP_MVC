<?php

class Freelance
{
    public $nombre;
    public $ocupado;
    const PRECIO_HORA = 10;
    public $comienzoTrabajo;

    /**
     * Freelance constructor.
     * @param $nombre
     * @param $ocupado
     * @param $comienzoTrabajo
     */
    public function __construct($nombre, $ocupado, $comienzoTrabajo) {
        $this->nombre = $nombre;
        $this->ocupado = $ocupado;
        $this->comienzoTrabajo = $comienzoTrabajo;
    }

    public function __destruct() {
        echo 'Estoy destruyendo a '.$this->nombre;
    }

    public function dimePrecio() {
        return self::PRECIO_HORA;
    }

    public function desarrollar() {
        echo 'Comienzo a trabajar';
    }
}

$trabajador = new Freelance('Paco', 'cupado', '08:00');

foreach ($trabajador as $key => $value) {
    echo $key.' - '.$value, PHP_EOL;
}