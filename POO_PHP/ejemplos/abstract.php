<?php


abstract class Mamifero // clase no instanciable
{
    protected $semanasDeGestacion;

    abstract function comunicar();

}

class Perro extends Mamifero
{
    function comunicar() {
        echo 'Guau guau';
    }
}

class Vaca extends Mamifero
{
    protected $litrosLecheDiarios;

    function comunicar() {
        echo 'Muuuuuu';
    }
}

class Jaula
{
    private $contenido;

    /**
     * Jaula constructor.
     * @param $contenido
     */
    public function __construct(Mamifero $contenido) {
        $this->contenido = $contenido;
    }

    public function escuchar() {
        $this->contenido->comunicar();
    }
}

// POLIMORFISMO

$perro = new Perro();
$vaca = new Vaca();

$jaula1 = new Jaula($perro);
$jaula2 = new Jaula($vaca);

$jaula1->escuchar();
$jaula2->escuchar();