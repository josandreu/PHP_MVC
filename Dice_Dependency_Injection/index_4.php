<?php
/********************

EJEMPLO INSTANCIAS COMPARTIDAS
Generalmente en una aplicación hay elementos que son requeridos por constructores, pero que queremos que esos constructores reciban siempre una misma instancia. Por ejemplo una conexión con la base de datos.

En estos casos generalmente creamos clases con el patrón singleton y así nos aseguramos que tenemos las mismas instancias. Luego puedes usar el patrón factoria para ayudarte a tener siempre disponible esa instancia compartida. Incluso puedes hacer clases con métodos estáticos que permitan invocarse en cualquier parte de tu código siempre que necesites acceder a esa instancia compartida.

Todo eso te lo puede resolver de otra manera el gestor de dependencias.

$ruleShared = new \Dice\Rule;
//marco que lo que deseeo es que se comparta la misma instancia de esta clase
$ruleShared->shared = true;
//lanzamos la regla sobre la clase RedLocal
$dice->addRule("RedLocal", $ruleShared);


Fíjate al final que los objetos comparten la red local
// Estos dos objetos comparten la red local
d($o->red == $o2->red);

 *********************/

use Dice\Dice;
use Dice\Rule;

require "vendor/autoload.php";


class Ordenador {
    private $pantalla;
    private $unidad_procesamiento;
    private $modelo;
    public $red;

    public function __construct(Pantalla $p, UnidadProcesamiento $up, $m, RedLocal $r){
        $this->pantalla = $p;
        $this->unidad_procesamiento = $up;
        $this->modelo = $m;
        $this->red = $r;
    }
}
class RedLocal{
    public $Mbps;

    public function __construct($velocidad = 100){
        $this->Mbps = $velocidad;
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

/***** REGLA INSTANCIA COMPARTIDA *******/

//marco que lo que deseeo es que se comparta la misma instancia de esta clase
//lanzamos la regla sobre la clase RedLocal
$dice = $dice->addRules([
    'A' => [
        'RedLocal' => true
    ]
]);

/***** FIN REGLA INSTANCIA COMPARTIDA *******/


/***** REGLA *******/

// creo la regla para configurar el constructor de la clase Memoria
// asocio esta regla a la clase Memoria
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

// Estos dos objetos comparten la red local
d($o->red == $o2->red);
$redLocalInstanciadaAparte = $dice->create("RedLocal");
d($o->red == $redLocalInstanciadaAparte);
