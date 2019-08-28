# Referencias

Las Referencias en PHP son medios de acceder al mismo contenido de una variable mediante diferentes nombres.

**Una referencia en PHP es un alias, que permite a dos variables diferentes escribir sobre un mismo valor.** Desde PHP 5, una **variable de tipo objeto** ya no contiene el objeto en sí como valor.

## Referencias a objetos

Una variable que contiene un objeto en realidad lo que tiene es una referencia a un objeto. (Apuntador, puntero).

`$fr1 = new Freelance();`

Asignar una variable a una referencia del objeto no clona el objeto. Son dos punteros apuntando al mismo lugar.

`$fr2 = $fr1;`

Si elimino uno de los punteros (referencias), el objeto perdura, pues aún le apunta el otro.

`unset($fr1);`

Cuando elimino el segundo puntero, el objeto se queda sin referencias y deja de existir.

`unset($fr2);`

## Valor y referencia

**Pasando por valor**

Cuando se declara una variable, el sistema operativo reserva un espacio de memoria en la memoria RAM.  
Cuando pasamos una variable a una función por valor, el sistema operativo reserva otro espacio de memoria distinto, de modo que **los cambios que sufra la variable en la función no afectarán a la variable de fuera de la función, aunque tengan el mismo nombre, ya que son variables distintas con espacios de memoria distintos.**

```php
function suma($num1, $num2) {
    echo $num1 + $num2;
}
```

**Pasando por referencia**

Cuando pasamos una variable a una función por referencia, realmente no estamos pasando el valor de la variable, sino la posición del espacio de memoria de esa variable (a esto se le llama puntero). De acuerdo a esto, los **cambios que sufra la variable dentro de la función afectarán a la variable fuera de la función, aunque tengan distintos nombres, ya que es la misma variable.**

Puedo asignar una variable por referencia. Así se queda
un puntero apuntando al otro.

```php 
$fr1 = new Freelance();
$fr2 = &$fr1;
```

> ATENCIÓN!!! En este caso, si igualamos la referencia $fr1 a "null", afectará a ambas referencias.

`$fr1 = null;`