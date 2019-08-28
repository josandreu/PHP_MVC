# Concepto de static

Son propiedades y métodos *de clase*, que no están asociados a ningún objeto en particular, sino de manera global a la clase.

- No necesitamos ningún objeto para acceder a las propiedades static o invocar métodos static
- No tiene sentido acceder con `$this`

```php
class Freelance
{
   public static $juegoCaracteres = "UTF8";
}
```

## Acceso a propiedades static

- Acceso desde fuera de la clase:

```php
echo "<b>" . Freelance::$juegoCaracteres . "</b>";
```

- Acceso a propiedad static dentro de la clase:

```php
echo "<b>" . self::$juegoCaracteres . "</b>";

public function desarrollar(){
    echo "<br>Soy " . $this->nombre; 
    echo " y comienzo a trabajar en "; 
    echo self::$juegoCaracteres; 
    $this->ocupado = true;              
    $this->comienzoTrabajo = time();
}
```

## Métodos static

Son métodos de clase, que no son particulares de un objeto o instancia de clase concreta. Es algo común para todos los objetos que se creen de una clase.

```php
public static function dias_trabajo() {

   if($invierno){
       return array("Lunes", "Martes", "Miércoles",
                    "Jueves", "Viernes", "Sábado", "Domingo");
    }
   return array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes");

}
```

## Acceso a métodos static

- Acceso desde fuera de la clase:

```php
Freelance::dias_trabajo();
```

- Acceso desde dentro de la clase:

```php
self::dias_trabajo();
```

**Remarcando: Lógicamente la palabra reservada "self" solo se puede acceder si estás dentro del código de una clase.**