<?php
/********************

EJEMPLO PARÁMETROS
En una clase podemos requerir parámetros de configuración. Por ejemplo, en la memoria, su tipo.

Podríamos crear la clase memoria con un constructor que recibe un parámetro con valor predeterminado, así el inyector de dependencias nos creará ese elemento con un valor por defecto.

class Memoria{
private $tipo;

public function __construct($t = "DDR3"){
$this->tipo = $t;
}
}

Pero si no somos nosotros los que crearon esa clase y no le pusieron ese valor predeterminado al declarar la función y no podemos (Generalmente tampoco queremos) tocar el código de la clase, se lo tenemos que pasar. Sin embargo como ese valor es un tipo primitivo (una cadena en este caso) no te lo va a generar el inyector de dependencias si no lo configuras.

// instancio la regla para configurar el constructor de la clase Memoria
$rule = new \Dice\Rule;

// asigno un comportamiento a esta regla
$rule->constructParams = ['DDR2'];

// asocio esta regla a la clase Memoria
$dice->addRule('Memoria', $rule);


 *********************/

use Dice\Dice;
use Dice\Rule;

require "vendor/autoload.php";
// probando dice

class Ordenador {
    private $pantalla;
    private $unidad_procesamiento;
    private $modelo;

    public function __construct(Pantalla $p, UnidadProcesamiento $up, $m){
        $this->pantalla = $p;
        $this->unidad_procesamiento = $up;
        $this->modelo = $m;
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
    private $tipo;

    public function __construct($t){
        $this->tipo = $t;
    }
}

class Procesador{

}

$dice = new Dice;

/***** REGLA *******/

// cuando me construyas memorias, lo haces con este parámetro
$dice = $dice->addRules([
    'Memoria' => [
        'constructParams' => ['DDR3']
    ]
]);

/***** FIN REGLA *******/

$o = $dice->create("Ordenador", ["HP Presidiario 4.0"]);
$o2 = $dice->create("Ordenador", ["Surface ME"]);

d($o);
d($o2);