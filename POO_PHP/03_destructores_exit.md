# Destructores

Se llaman en el mismo instante en el que un objeto se queda sin ninguna referencia.

```php
public function __destruct() {
    echo 'Estoy destruyendi a '.$this->nombre;
}
```

# Destructores y exit()

Incluso si hacemos un exit() desde cualquier parte de PHP, se llamará a los destructores.

Llamar a exit() en un destructor hará que se eviten las diversas finalizaciones de los objetos.

