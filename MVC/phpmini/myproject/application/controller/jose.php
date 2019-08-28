<?php

use App\core\Controller;

class Jose extends Controller
{
    public function index() {
        echo '<h1>Hola maricon</h1>';
    }

    public function acercaDe() {
        echo 'Jose es un desarrollador nacido en Zaragoza';
    }

    public function comer($comida = 'penes', $lugar='casa') {
        echo date('d/m/Y').'<br>';
        echo 'Jose come '.$comida.' en '.$lugar;
    }
}