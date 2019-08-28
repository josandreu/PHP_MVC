# Patrón Singleton

## Claves

- Solo permite una instancia del objeto
- No permite instanciarlo desde fuera, gracias a que el constructor es declarado como privado.
    - Esto impide instanciarlo desde fuera de la clase
    - Por esa razón, el objeto se instancia desde la propia clase
- Lo que se hace es declarar una propiedad privada y static, donde guardaremos la instancia del objeto. Esta variable se inicia a null.
- En el método que instancia al objeto se comprueba si esta variable es null, y si lo es, entonces se instancia el objeto.
- Esto lo implementamos porque sólo queremos tener una instancia de la conexión con la bbdd en toda la app.

```php
class Singleton {

    private static $instancia = null;
    
    private function __construct() {
        // tareas de inicialización
    }
    
    public static function getInstance() {
        if (is_null(self::$instancia)) {
            self::$instancia = new Singleton();
        }
        return self::$instancia;
    }
}
```