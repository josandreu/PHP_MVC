<?php
/*
 * Se trata de una clase que genera links, al instanciar un objeto Enlace se pasa como argumento la url y el texto
 * Tiene un método que imprime los enlaces
 * Es utilizada desde index.php
 */

class Enlace {

    private $href;
    private $texto;

    /**
     * Enlace constructor.
     * @param $href
     * @param $texto
     */
    public function __construct(string $href, string $texto)
    {
        $this->href = $href;
        $this->texto = $texto;
    }

    // esta función retorna un string
    public function imprimeLink() : string {
        return '<a href="http://'.$this->href.'" target="_blank">'.$this->texto.'</a>';
    }

    // esta función no retorna nada, simplemente realiza un echo, utilizamos dobles comillas y la barra \ para escapar
    public function imprimeLink2() {
        echo "<a href=\"http://$this->href\" target=\"_blank\">$this->texto</a>";
    }

}