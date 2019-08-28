# Herencia (extends)

**En OOP**: transmisión de los atributos y métodos desde una clase a otra.

> Ej: Clase Mamífero. Define una serie de propiedades y atributos que transmite a todos los que heredan de Mamífero.
> Propiedades: Se definen Macho/Hembra. Las hembras producen leche.
> Métodos: Gestar (en la barriga de la hembra), mamar (las crías de los pechos de la madre)

La herencia permite reutilizar el código cuando creas "especializaciones" en tus clases y facilita que la complejidad no se dispare en esas especializaciones.

> Clase perro, persona o elefante reutilizamos código de la clase mamífero.
> En la clase coche, o moto, reutilizamos código de la clase vehículo.

# Herencia. Hija / Padre

Clase hija hereda los atributos y métodos de la clase padre.

La clase hija se especializa siempre, añadiendo nuevas propiedades, métodos o sobreescribiendo los anteriores.

# Cuando hacer herencia?

Si en tu clasificación encuentras unos objetos que son la especialización de otros...

**¿La _CLASE HIJA_ es un _CLASE PADRE_ ?**

> Un _perro_ es un _mamífero_?

> Un _coche_ es un _vehículo_?

# Visibilidad en la herencia

**private**

- Los métodos y propiedades "private" NO se pueden acceder desde las clases hijas!!

**protected**

- Para ello se ha creado "protected" que es igual que private, pero sí que se transmite visibilidad a los hijos.

# Usos

1. Imagina que existe una clase que ya has utilizado, sabes que funciona, quieres utilizarla pero no quieres modificarla ni hacer ningún cambio en ella.
   - Es tan sencillo como crear otra clase que hereda de la primera, de esta forma dispones de los mismos métodos y atributos sin tener que tocar nada de la primera.

# Redefinición de métodos

Se trata de escribir de nuevo el código de uno de los métodos heredados.

> Se redefine el método, por tanto en la clase hija el método que exista será el reescrito y no el que había originalmente en la clase padre.

**Requiere usar el mismo nombre y los mismos parámetros.**

> (No confundir con Sobrecarga, que es otra cosa y en PHP es algo especial)

## Uso de parent::nombreMetodo

Cuando redefinimos un método, podemos (y generalmente será apropiado) apoyarnos en el código del método de la clase padre, usando parent::nombreMetodoPadre.

```php
public function mostrar(){
//invoco al método mostrar de la clase padre
//reutilizo código escrito en la clase padre
parent::mostrar();
//hago la parte de mostrar() que sería propia de la clase hija
echo $this->atributo_a_mostrar_que_es_del_hijo();
}
```

## Constructores y parent

El constructor de la clase hija puede apoyarse también en la clase padre.

```php
class Prisma extends Rectangulo {
   function __construct($altura, $anchura, $profundidad){
        parent::__construct($altura, $anchura);
        $this->profundidad = $profundidad;
   }
}
```
