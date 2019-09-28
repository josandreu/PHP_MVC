<?php
$miarray = array(23, 67.8, "hola esto es un json", "otro campo", true, array(3,8), -5);

$miarray = array("datos" => $miarray); // de esta forma metemos el array en un array asociativo, y a la hora de convertirlo en un JSON, se convierte en un objeto

$miasociativo = array(
    "ciudad" => "Madrid",
    "peso" => "3kg",
    "fecha" => "4/3/02",
    "dias" => array("lunes", "Miércoles", "Viernes"),
    "hombre" => false,
    "proximo" => 223
);

class Alumno {
    private $nombre;
    public $apellido1;
    public $apellido2;
    public $asignaturas;

    public function __construct($nombre, $apellido1, $apellido2, array $asignaturas){
        $this->nombre = $nombre;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->asignaturas = $asignaturas;
    }

    public function toJson() {
        return json_encode($this);
    }
}
$mialumno = new Alumno("Pepe", "Pelote", "Pinto", array("Mates", "Física", "Química"));

//echo json_encode($miasociativo);
//echo json_encode($miarray);
//echo json_encode($mialumno); // nombre no lo vemos xq es privado, no accesible desde fuera
echo $mialumno->toJson();