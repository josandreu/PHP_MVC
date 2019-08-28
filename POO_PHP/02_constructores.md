# Constructores

Resumen las tareas de inicialización de los objetos, en el instante que son iniciados.

El constructor NO CONSTRUYE NADA, simplemente lo que hacen es INICIALIZAR el objeto que se está creando.

```php
function __construct(string $nombre) {
    $this->nombre = $nombre;
}
```

### En PHP NO hay sobrecarga nativa de constructores.

