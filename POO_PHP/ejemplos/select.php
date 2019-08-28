<?php

/*
 * Clase que genera HTML option juntos con los selects.
 * Pasas en el constructor el nombre del select como primer argumento
 * Como 2º argumento, un array indexado en el que la key será el value del option y el texto a mostrar será el value (key => value)
 */
class Select
{
    private $name;
    private $data;

    /**
     * Select constructor.
     * @param $name
     * @param $data
     */
    public function __construct($name, $data) {
        $this->data = $data;
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getData() {
        return $this->data;
    }

    public function write($id = '', $attributes = "") {
        if ($id == null || $id == '') {
            $id = $this->getName();
        }
        $options = $this->generateData();
        //var_dump($options);
        $name = $this->getName();
        echo "<select name=\"$name\" id=\"$id\" $attributes >";
        echo $options;
        echo '</select>';
    }

    // "key" => value
    protected function generateData() : string {
        $options = "";
        foreach ($this->getData() as $value => $text) {
            $options .= "<option value=\"$value\">$text</option>\n";
        }
        return $options;
    }

}

