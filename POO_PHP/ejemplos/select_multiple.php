<?php

/*
 * Clase que hereda de SelectExtends, que a su vez hereda de Select
 * por lo que tendremos disponible la funcionalidad extra de SelectDefault
 * y añadimos más funcionalidades
 */
final class SelectMultiple extends SelectDefault
{
    protected $multiple = false;

    public function __construct($name, $data, $default = null, $multiple = false) {
        parent::__construct($name, $data, $default);
        $this->multiple = $multiple;
    }

    // utilizamos herencia y parent para redefinir la función write()
    // por defecto, el select será múltiple y además si pasamos como argumento
    // cualquier otro atributo, lo concatena
    public function write($id = '', $attributes = null) {
        parent::write($id, "multiple ".$attributes);
    }

    // en esta función hacemos uso de la propiedad $multiple, sin utilizar herencia
    public function write_2($id = '', $attributes = null) {
        if ($id == null || $id == '') {
            $id = $this->getName();
        }
        $options = $this->generateData();
        //var_dump($options);
        $name = $this->getName();
        echo "<select ";
        if ($this->multiple == true) {
          echo "multiple ";
        }
        echo "name=\"$name\" id=\"$id\" $attributes >";
        echo $options;
        echo '</select>';
    }


}