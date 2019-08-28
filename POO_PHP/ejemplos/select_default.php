<?php

/*
 * Clase que hereda de Select
 * Añadimos una nueva propiedad para poder marcar un option como selected
 * Vamos a redefinir el método generateData para que podamos marcar un option como default
 */
class SelectDefault extends Select
{
    protected $default = null;

    /**
     * Select_extends constructor.
     * @param $name
     * @param $data
     * @param null $default
     */
    public function __construct($name, $data, $default = null) {
        parent::__construct($name, $data);
        $this->default = $default;
    }

/*
    public function markAsDefault($value) {
        $this->default = $value;
    }
*/

    protected function generateData(): string {
        $options = "";
        foreach ($this->getData() as $value => $text) {
            if ($this->default == $value)
                $options .= "<option value=\"$value\" selected=\"selected\">$text</option>\n";
            else
                $options .= "<option value=\"$value\">$text</option>\n";
        }
        return $options;
    }

    /* OTRA FORMA DE IMPLEMENTARLO
     *
     protected function generateData(): string {
        $options = "";
        foreach ($this->getData() as $value => $text) {
            $options .= "<option "
            if ($this->default == $value)
                $options .= "selected=\"selected\"";
            $options .= " value=\"$value\">$text</option>\n";
        }
        return $options;
     }
     */


}