<?php

/********************

EJEMPLO BÁSICO
Creamos una jerarquía de clases que reciben sus dependencias en los constructores

 *********************/
// importamos Dice
use Dice\Dice;
// cargando las librerías de composer
require "vendor/autoload.php";

// probando Dice

class Ordenador {
    private $pantalla;
    private $cpu;

    /**
     * Ordenador constructor.
     * @param $pantalla
     * @param $cpu
     */
    public function __construct(Pantalla $pantalla, Cpu $cpu) {
        $this->pantalla = $pantalla;
        $this->cpu = $cpu;
    }
}

class Pantalla {

}

class Cpu {
    private $memoria;
    private $procesador;

    /**
     * Cpu constructor.
     * @param $memoria
     * @param $procesador
     */
    public function __construct(Memoria $memoria, Procesador $procesador) {
        $this->memoria = $memoria;
        $this->procesador = $procesador;
    }
}

class Memoria {

}

class Procesador {

}
// creamos un objeto Dice (contenedor de dependencias), se encargará de crear las dependencias necesarias de cada objeto, en el orden que se requiera
$dice = new Dice();
// creamos un ordenador a través de Dice
$ordenador = $dice->create('Ordenador');

d($ordenador);