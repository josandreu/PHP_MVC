# namespace

En su definición más aceptada, los espacios de nombres son una manera de encapsular elementos.

En el mundo de PHP, los espacios de nombres están diseñados para solucionar dos problemas con los que se encuentran los autores de bibliotecas y de aplicaciones al crear elementos de código reusable, tales como clases o funciones:

1. El conflicto de nombres entre el código que se crea y las clases/funciones/constantes internas de PHP o las clases/funciones/constantes de terceros.

2. La capacidad de apodar (o abreviar) Nombres_Extra_Largos diseñada para aliviar el primer problema, mejorando la legibilidad del código fuente.

**Los espacios de nombres de PHP proporcionan una manera para agrupar clases, interfaces, funciones y constantes relacionadas.**

**Solamente se ven afectados por espacios de nombres los siguientes tipos de código: clases (incluyendo abstractas y traits), interfaces, funciones y constantes.**

---
## Ejemplo

Supongamos la siguiente clase:

```php 
// MiClase.php
class MiClase {
// ...codigo
}
```

Si queremos instanciar la clase desde otro archivo bastará con escribir:

```php 
include 'MiClase.php';

$miClase = new MiClase;
}
```

>Con un proyecto sencillo no habría dificultades con esta metodología. Los problemas pueden venir cuando el proyecto aumenta y puede ocurrir que coincidan clases, funciones o constantes de PHP o de librerías de terceros con las del propio proyecto.

Supongamos ahora que coche.php está en un nuevo directorio:

```php
// Directorio: Proyecto/Prueba/MiClase.php
namespace Proyecto\Prueba;

class MiClase {
//...
}
```
> La única construcción de código permitida antes de la declaración de un espacio de nombres es la sentencia *declare* para declarar la codificación de un fichero fuente. 

**Para utilizar la clase:**

```php
include 'Proyecto/Prueba/MiClase.php';

$miClase = new Proyecto\Prueba\MiClase;
```

---
### Subespacio de nombres

```php
<?php
namespace MiProyecto\Sub\Nivel;

const CONECTAR_OK = 1;
class Conexión { /* ... */ }
function conectar() { /* ... */  }

?>
```

> El ejemplo de arriba crea la constante MiProyecto\Sub\Nivel\CONECTAR_OK,  
la clase MiProyecto\Sub\Nivel\Conexión  
y la función MiProyecto\Sub\Nivel\conectar.

---
## Uso de los espacios de nombres

1. Nombre no cualificado, o nombre de clase sin prefijo como **$a = new foo();** o **foo::método_estático();**. Si el espacio de nombres actual es *espacio_de_nombres_actual*, esto se resuelve con *espacio_de_nombres_actual\foo*. Si el código es global, es decir, no es de espacio de nombres, esto se resuelve con foo. Una advertencia: los nombres no cualificados para funciones y constantes se resolverán con funciones y constantes globales si la función o la constante del espacio de nombres no está definida.

2. Nombre cualificado, o un nombre de clase con prefijo como **$a = new subespacio_de_nombres\foo();** o **subespacio_de_nombres\foo::método_estático();**. Si el espacio de nombres actual es *espacio_de_nombres_actual*, esto se resuelve con *espacio_de_nombres_actual\subespacio_de_nombres\foo*. Si el código es global, es decir, no es de espacio de nombres, esto se resuelve con subespacio_de_nombres\foo.

3. Nombre completamente cualificado, o un nombre con prefijo con el operador de prefijo global como **$a = new \espacio_de_nombres_actual\foo();** o **\espacio_de_nombres_actual\foo::método_estático();**. Esto siempre se resuelve con nombre literal especificado en el código, *espacio_de_nombres_actual\foo*.

---
### Ejemplo

`fichero1.php`
```php
<?php
namespace Foo\Bar\subespacio_de_nombres;

const FOO = 1;
function foo() {}
class foo
{
    static function método_estático() {}
}
?>
```

`fichero2.php`
```php
<?php
namespace Foo\Bar;
include 'fichero1.php';

const FOO = 2;
function foo() {}
class foo
{
    static function método_estático() {}
}

/* Nombre no cualificado */
foo(); // se resuelve con la función Foo\Bar\foo
foo::método_estático(); // se resuelve con la clase Foo\Bar\foo, método método_estático
echo FOO; // se resuelve con la constante Foo\Bar\FOO

/* Nombre cualificado */
subespacio_de_nombres\foo(); // se resuelve con la función Foo\Bar\subespacio_de_nombres\foo
subespacio_de_nombres\foo::método_estático(); // se resuelve con la clase Foo\Bar\subespacio_de_nombres\foo,
                                              // método método_estático
echo subespacio_de_nombres\FOO; // se resuelve con la constante Foo\Bar\subespacio_de_nombres\FOO
                                  
/* Nombre conmpletamente cualificado */
\Foo\Bar\foo(); // se resuelve con la función Foo\Bar\foo
\Foo\Bar\foo::método_estático(); // se resuelve con la clase Foo\Bar\foo, método método_estático
echo \Foo\Bar\FOO; // se resuelve con la constante Foo\Bar\FOO
?>
```
> 2  
1  
2


---
## La palabra reservada namespace y la constante '__ NAMESPACE__'

PHP admite dos formas de acceder de manera abstracta a elementos dentro del espacio de nombres actual: la constante mágica `__NAMESPACE__`, y la palabra reservada *namespace*.

El valor de `__NAMESPACE__` es una cadena que **contiene el nombre del espacio de nombres actual.** En código global, que no es de espacio de nombres, contiene una cadena vacía.

```php
<?php
namespace MiProyecto;

echo '"', __NAMESPACE__, '"'; // imprime "MiProyecto"
?>
```
```php
<?php

echo '"', __NAMESPACE__, '"'; // imprime ""
?>
```

---
## Namespaces dinámicos

Para acceder dinámicamente a un namespace:

```php
namespace Proyecto;
// Definimos una clase, una función y una constante bajo el namespace Proyecto
class MiClase {
    function __construct() {
        echo __METHOD__ . "<br>";
    }
}
function miFuncion() {
    echo __FUNCTION__ . "<br>";
}
const MICONSTANTE = "Constante para namespaces <br>";
// En el mismo archivo llamándolos directamente:
$x = new MiClase; // Devuelve: Proyecto\MiClase::__construct
miFuncion(); // Devuelve: Proyecto\miFuncion
echo MICONSTANTE; // Devuelve: Constante para namespaces
// Si en cambio se inicia la clase, función o contante desde un string:
$x = 'MiClase';
$objeto = new $x; // Fatal error Class MiClase not found
$y = 'miFuncion';
$y(); // Fatal error: Call to undefined function miFuncion()
echo constant('MICONSTANTE'); // Warning: constant(): Couldn't find constant MICONSTANTE
```

La razón por la que no funcionan mediante llamamientos dinámicos es porque dependen de si las llamadas se traducen durante la compilación o no.

```php
// Si obtenemos la clase con el namespace completo desde un string:
$x = 'Proyecto\MiClase';
$objeto = new $x; // Devuelve: Proyecto\MiClase::__construct
$y = 'Proyecto\miFuncion';
$y(); // Devuelve: Proyecto\miFuncion
echo constant('Proyecto\MICONSTANTE') . "<br>"; // Devuelve: Constante para namespaces
// No importa incluir o no la barra invertida inicial:
$x = '\Proyecto\MiClase';
$objeto = new $x; // Devuelve: Proyecto\MiClase::__construct
$x = 'Proyecto\MiClase';
$objeto = new $x; // Devuelve: Proyecto\MiClase::__construct
// Aunque sí que importa si se define directamente la clase en el mismo archivo:
$x = new \Proyecto\MiClase; // Devuelve: Proyecto\MiClase::__construct
$x = new Proyecto\Miclase; // Fatal error: Class 'Proyecto\Proyecto\Miclase' not found
// Esto último también se clarifica en la sección sobre las reglas de resolución de los namespaces, concretamente en la regla número 3
```

---
## La palabra reservada namespace

La palabra reservada namespace es equivalente a **self** en las clases. Se utiliza para solicitar un elemento del namespace actual:

```php
<?php
namespace MiProyecto;

namespace\miFuncion(); // llama a MiProyecto\miFuncion()
namespace\MiClase::metodo(); // llama al método estático metodo() de la clase MiClase. Equivale a MiProyecto\Miclase::metodo()
namespace\CONSTANTE  // llama a la constante CONSTANTE como MiProyecto\CONSTANTE
```

---
##  Importar un namespace (use)

Si tenemos que utilizar una clase varias veces en un archivo, podemos **evitar tener que escribir el namespace tantas veces importándolo**, así después solo habrá que escribir la clase:

```php
include 'Proyecto/Prueba/MiClase.php';

use Proyecto\Prueba\MiClase;

$miClase = new MiClase;
```

**La importación se realiza durante la compilación y no durante la ejecución, por eso se declara en el ámbito global de un archivo.**

---
## Apodar un namespace (use)

También es posible utilizar un alias para **utilizar una clase bajo un nombre diferente:**

```php
include 'Proyecto/Prueba/MiClase.php';

use Proyecto\Prueba\MiClase as Clase;

$miClase = new Clase; // instancia un objeto de la clase Proyecto\Prueba\MiClase

// No es posible con nombres dinámicos
$x = 'MiClase';
$objeto = new $x; // instancia de la clase MiClase. No detecta el apodo
```

---
## Espacio global en los namespaces

Sin ninguna definición de espacios de nombres, todas las definiciones de clases y funciones son colocadas en el espacio global, como si lo estuvieran antes de que PHP soportara los espacios de nombres.

Cuando se emplean namespaces, hay que tener en cuenta las clases globales. En un archivo donde se emplea un namespace, si se crea una clase Datetime() se instanciará la clase del mismo:

```php
class Datetime extends \Datetime {
    public function getTimestamp()
    {
        echo "¡Hola!";
    }
}

$propia = new Datetime();
echo $propia->getTimestamp(); // Devuelve !Hola!
```

**Para instanciar la clase global es necesario emplear \ delante de Datetime() al instanciarla:**

```php
class Datetime extends \Datetime {
    public function getTimestamp()
    {
        echo "¡Hola!";
    }
}

$propia = new \Datetime();
echo $propia->getTimestamp(); // Devuelve el timestamp en formato Unix
```

> Prefijar un nombre con \ especificará que el nombre es requerido desde el espacio global incluso en el contexto del espacio de nombres.

```php 
<?php
namespace A\B\C;

/* Esta función es A\B\C\fopen */
function fopen() { 
     /* ... */
     $f = \fopen(...); // llamar a fopen global
     return $f;
} 
?>
```

```php
<?php
namespace A\B\C;
class Exception extends \Exception {}

$a = new Exception('hola'); // $a es un objeto de la clase A\B\C\Exception
$b = new \Exception('hola'); // $b es un objeto de la clase Exception

$c = new ArrayObject; // error fatal, no se encontró la clase A\B\C\ArrayObject
?>
```

> Acceder a clases globales dentro de un espacio de nombres

---
## Reglas de resolución de los namespace

### Definiciones importantes:

1. **Unqualified name** 
   - identificador sin separador: MiProyecto

2. **Qualified name** 
   - identificador con separador: MiProyecto\Prueba

3. **Fully qualified name** 
   - nombre cualificado que comienza con un separador: \MiProyecto\Prueba

### Reglas:

1. Las llamadas a clases, funciones o constantes con **fully qualified name** se resuelven durante la compilación. Ej: new \MiProyecto\Prueba será la clase MiProyecto\Prueba.

2. Los **qualified** y **unqualified names** se traducen durante la compilación según las reglas de importación (como la generación de alias). Ej: MiProyecto\Prueba as Prueba, una llamada a Prueba\Test\miFuncion se traduce como MiProyecto\Prueba\Test\miFuncion.

3. Dentro de un namespace, todos los nombres **qualified** no traducidos llevan antepuesto el namespace actual. Ej: si una llamada a Prueba\Test\miFuncion se lleva a cabo en el namespace MiProyecto, se traduce como MiProyecto\Prueba\Test\miFuncion.

4. Los namespaces **unqualified** se traducen durante la compilación según las reglas de compilación. Ej: si MiProyecto\Prueba\Test se importa como Test, new Test() se traduce como new MiProyecto\Prueba\Test().

5. Dentro de un namespace (MiProyecto\Prueba), las llamadas a **funciones unqualified** se resuelven durante la ejecución. Ej: si se llama a miFuncion():
   1. Se busca en el namespace actual MiProyecto\Prueba\miFuncion
   2. Se intenta encontrar y llamar a la función global miFuncion

6. Dentro de un namespace, MiProyecto\Prueba, los namespaces **qualified** y **unqualified** se resuelven durante la ejecución. Ej: Si se llama a new Test():
   1. Se busca la clase en el namespace actual MiProyecto\Prueba\Test
   2. Se intenta cargar automáticamente MiProyecto\Prueba\Test Si se llama a new Otro\otraFuncion():
   1. Se busca la clase en el namespace actual MiProyecto\Prueba\Otro\otraFuncion()
   2. Se intenta cargar automáticamente MiProyecto\Prueba\Otro\otraFuncion()

7. Para referirse a **cualquier clase global** en el **namespace global**, se debe emplear el **fully qualified name** new \miFuncion().

```php
<?php
namespace A;
use B\D, C\E as F;

// llamadas a funciones

foo();      // primero se intenta llamar a "foo" definida en el espacio de nombres "A"
            // después se llama a la función global "foo"

\foo();     // se llama a la función "foo" definidia en el ámbito global

mi\foo();   // se llama a la función "foo" definida en el espacio de nombres "A\mi"

F();        // primero se intenta llamar a "F" definida en el espacio de nombres "A"
            // después se llama a la función global "F"

// referecias a clases

new B();    // crea un objeto de la clase "B" definida en el espacio de nombres "A"
            // si no se encuentra, se intenta autocargar la clase "A\B"

new D();    // usando las reglas de importación, se crea un objeto de la clase "D" definida en el espacio de nombres "B"
            // si no se encuentra, se intenta autocargar la clase "B\D"

new F();    // usando las reglas de importación, se crea un objeto de la clase "E" definida en el espacio de nombres "C"
            // si no se encuentra, se intenta autocargar la clase "C\E"

new \B();   // crea un objeto de la clase "B" definida en el ámbito global
            // si no se encuentra, se intenta autocargar la clase "B"

new \D();   // crea un objeto de la clase "D" definida en el ámbito global
            // si no se encuentra, se intenta autocargar la clase "D"

new \F();   // crea un objeto de la clase "F" definida en el ámbito global
            // si no se encuentra, se intenta autocargar la clase "F"

// métodos estáticos y funciones de un espacio de nombres desde otro espacio de nombres

B\foo();    // se llama a la función "foo" desde el espacio de nombres "A\B"

B::foo();   // se llama al método "foo" de la clase "B" definidia en el espacio de nombres "A"
            // si no se encuentra la clase "A\B", se intenta autocargar la clase "A\B"

D::foo();   // usando las reglas de importación, se llama al método "foo" de la clase "D" definida en el espacio de nombres "B"
            // si no se encuentra la clase "B\D", se intenta autocargar la clase "B\D"

\B\foo();   // se llama a la función "foo" desde el espacio de nombres "B"

\B::foo();  // se llama al método "foo" de la clase "B" desde el ámbito global
            // si no es encuentra la clase "B", se intenta autocargar la clase "B"

// métodos estáticos yfunciones de un espacio de nombres del espacio de nombres actual

A\B::foo();   // se llama al método "foo" de la clase "B" desde el espacio de nombres "A\A"
              // si no se encuentra la clase "A\A\B", se intenta autocargar la clase "A\A\B"

\A\B::foo();  // se llama al método "foo" de la clase "B" desde el espacio de nombres "A"
              // si no se encuentra la clase "A\B", se intenta autocargar la clase "A\B"
?>
```