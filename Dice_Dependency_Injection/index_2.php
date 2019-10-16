<?php
/********************

EJEMPLO PARÁMETROS
La clase ordenador recibe un parámetro en el constructor.
lo podemos definir con el create;
$o = $dice->create("Ordenador", ["HP Presidiario 4.0"]);

 *********************/

use Dice\Dice;

require "vendor/autoload.php";

class Ordenador {
    private $pantalla;
    private $unidad_procesamiento;
    private $modelo;

    public function __construct(Pantalla $p, UnidadProcesamiento $up, $modelo){
        $this->pantalla = $p;
        $this->unidad_procesamiento = $up;
        $this->modelo = $modelo;
    }
}

class Pantalla {

}

class UnidadProcesamiento{
    private $memoria;
    private $procesador;

    public function __construct(Memoria $m, Procesador $p){
        $this->memoria = $m;
        $this->procesador = $p;
    }
}

class Memoria{

}
class Procesador{

}

$dice = new Dice;
$o = $dice->create("Ordenador", ["HP Presidiario 4.0"]);
$o2 = $dice->create("Ordenador", ["Surface ME"]);

d($o);
d($o2);