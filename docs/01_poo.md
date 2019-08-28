# Programación Orientada a Objetos en PHP

![classes](./img/classes.png)

### Para poder utilizar una clase en otro archivo:

- require / include  
La sentencia **require** es idéntica a **include** excepto que en caso de fallo producirá un error fatal de nivel E_COMPILE_ERROR. En otras palabras, éste detiene el script mientras que include sólo emitirá una advertencia (E_WARNING) lo cual permite continuar el script.

- require_once / include_once  
La sentencia **require_once** es idéntica a **require** excepto que PHP verificará si el archivo ya ha sido incluido y si es así, no se incluye (require) de nuevo.

- Autocarga de clases spl_autoload_register
```php
// se carga la clase que necesitemos sin necesidad de realizar un include/require para cada clase
spl_autoload_register(function ($nombre_clase) {
    include $nombre_clase . '.php';
});
```
---
## Constructores

Aquellas que tengan un método constructor lo invocarán en cada nuevo objeto creado, lo que lo hace idóneo para cualquier inicialización que el objeto pueda necesitar antes de ser usado.

Los constructores padres no son llamados implícitamente si la clase hija define un constructor.  
Para ejecutar un constructor padre, se requiere invocar a parent::__construct() desde el constructor hijo.  
Si el hijo no define un constructor, entonces se puede heredar de la clase madre como un método de clase normal (si no fue declarada como privada).

---
## static ::

- Declarar propiedades o métodos de clases como estáticos los hacen accesibles sin la necesidad de instanciar la clase.  
- Una propiedad declarada como static no puede ser accedida con un objeto de clase instanciado (aunque un método estático sí lo puede hacer).  

### Métodos estáticos

Debido a que los métodos estáticos se pueden invocar sin tener creada una instancia del objeto, la seudovariable $this no está disponible dentro de los métodos declarados como estáticos.

- Llamar a un método estático: `NombreClase::nombreMetodo`
- Con el operador `::`

### Propiedades estáticas

No se puede acceder a las propiedades estáticas a través del objeto utilizando el operador flecha (->).

Como cualquier otra variable estática de PHP, las propiedades estáticas sólo pueden ser inicializadas utilizando un string literal o una constante; **las expresiones no están permitidas.**  
Por tanto, **se puede inicializar una propiedad estática** con:  
- enteros o arrays (por ejemplo).  

Pero **no se puede inicializar** con:  
- otra variable, con el valor de devolución de una función, o con un objeto.

```php
<?php
class Foo
{
    public static $mi_static = 'foo';

    public function valorStatic() {
        return self::$mi_static;
    }
}

class Bar extends Foo
{
    public function fooStatic() {
        return parent::$mi_static;
    }
}


print Foo::$mi_static . "\n";

$foo = new Foo();
print $foo->valorStatic() . "\n";
print $foo->mi_static . "\n";      // "Propiedad" mi_static no definida

print $foo::$mi_static . "\n";
$nombreClase = 'Foo';
print $nombreClase::$mi_static . "\n"; // A partir de PHP 5.3.0

print Bar::$mi_static . "\n";
$bar = new Bar();
print $bar->fooStatic() . "\n";
?>
```

---
## Herencia (extends)

Los métodos y propiedades heredados pueden ser sobrescritos con la redeclaración de éstos utilizando el mismo nombre que en la clase madre.  
Sin embargo, si la clase madre definió un método como final, éste no podrá ser sobrescrito.  
Es posible acceder a los métodos sobrescritos o a las propiedades estáticas haciendo referencia a ellos con **parent::**  
Cuando se **sobrescriben métodos**, la firma de los parámetros debería ser la misma o PHP generará un error de nivel E_STRICT. Esto no se aplica a los **constructores, los cuales permiten la sobrescritura con diferentes parámetros**.

```php
<?php
class ClaseExtendida extends ClaseSencilla
{
    // Redefinición del método padre
    function mostrarVar()
    {
        echo "Clase extendida\n";
        parent::mostrarVar();
    }
}

$extendida = new ClaseExtendida();
$extendida->mostrarVar();
?>
```

---
## Modificadores de acceso

Los métodos y atributos de una clase pueden tener diferentes níveles de acceso, los cuáles pueden ser:

- **public**  
Propiedades/métodos pueden ser accedidas desde cualquier parte de la aplicación, sin restricción.  
- **static**  
Pueden ser accedidos sin necesidad de instanciar un objeto y su valor es estático (es decir, no puede variar ni ser modificado).
- **private**  
Cuando se define una propiedad/método como private, se indica que ésta no puede verse o modificarse a no ser que sea desde la propia clase que lo definió.
- **protected**    
Hace que la variable/función se puede acceder desde la clase que las define y también desde cualquier otra clase que herede de ella.

**En otras palabras: private = solo tú, protected = tú y tus descendientes, public = cualquiera.**

---
## Acceso a los objetos

Para acceder a los métodos y atributos de un objeto, existen diferentes maneras de hacerlo. Todas ellas, dependerán del ámbito desde el cual se les invoque así como de su condición y visibilidad

- Dentro de la Clase
- Fuera de la Clase

### DENTRO DE LA CLASE Y NO SIENDO ESTÁTICO

Utilizando la pseudo-variable **$this**, siendo esta una referencia al objeto mismo:

```php
<?php

class NombreDeMiClase {

	$this->atributo;
	
	$this->metodo();

}
```

### DENTRO DE LA CLASE Y SIENDO ESTÁTICO

Se accede mediante el **operador de resolución de ámbito**, (doble dos puntos ::) anteponiendo la palabra clave self o parent según se trate de una propiedad de la misma clase o de otra heredada.

```php
<?php

class NombreDeMiClase {

	self::atributo_estatico_de_esta_clase;
	parent::atributo_estatico_de_clase_madre;
	
	self::metodo_estatico_de_esta_clase();
	parent::metodo_estatico_de_clase_madre();

}
```

### FUERA DE LA CLASE Y NO SIENDO ESTÁTICO

Se necesita instanciar un objeto de la clase y sólo se pueden acceder a métodos y atributos públicos

```php
<?php

$objeto = new Clase();

$objeto->atributo_publico;

$objeto->metodo_publico();
```

### FUERA DE LA CLASE Y SIENDO ESTÁTICO

No es necesario instanciar la clase. Sólo se pueden acceder a métodos y atributos públicos

```php
<?php

Clase::atributo_publico;

Clase::metodo_publico();
```


---
## Clases abstractas

Las **clases** definidas como abstractas **no se pueden instanciar** y cualquier clase que contiene al menos un método abstracto debe ser definida como tal.  
Los **métodos** definidos como abstractos simplemente **declaran la firma del método, pero no pueden definir la implementación.**

Son aquellas que no necesitan ser instanciadas pero sin embargo, serán heredadas en algún momento. Su finalidad, es la de declarar clases genéricas que necesitan ser declaradas pero a las cuales, no se puede otorgar una definición precisa

### Herencia con clases abstractas

Cuando se hereda de una clase abstracta, todos los métodos definidos como abstractos en la declaración de la clase madre deben ser definidos en la clase hija; además, estos métodos deben ser definidos con la misma (o con una menos restrictiva) visibilidad.

Las firmas de los métodos tienen que coincidir, es decir, la declaración de tipos y el número de argumentos requeridos deben ser los mismos.

```php
<?php
abstract class ClaseAbstracta
{
    // Forzar la extensión de clase para definir este método
    abstract protected function getValor();
    abstract protected function valorPrefijo($prefijo);

    // Método común
    public function imprimir() {
        print $this->getValor() . "\n";
    }
}

class ClaseConcreta1 extends ClaseAbstracta
{
    protected function getValor() {
        return "ClaseConcreta1";
    }

    public function valorPrefijo($prefijo) {
        return "{$prefijo}ClaseConcreta1";
    }
}

class ClaseConcreta2 extends ClaseAbstracta
{
    public function getValor() {
        return "ClaseConcreta2";
    }

    public function valorPrefijo($prefijo) {
        return "{$prefijo}ClaseConcreta2";
    }
}

$clase1 = new ClaseConcreta1;
$clase1->imprimir();
echo $clase1->valorPrefijo('FOO_') ."\n";

$clase2 = new ClaseConcreta2;
$clase2->imprimir();
echo $clase2->valorPrefijo('FOO_') ."\n";
?>
```

---
## Interfaces de objetos (implements)

Las interfaces de objetos permiten crear código con el cual especificar qué métodos deben ser implementados por una clase, sin tener que definir cómo estos métodos son manipulados.

Una misma clase, puede implementar múltiples interfaces.

Las interfaces se definen de la misma manera que una clase, aunque reemplazando la palabra reservada class por la palabra reservada interface y sin que ninguno de sus métodos tenga su contenido definido.

Todos los métodos declarados en una interfaz deben ser públicos, ya que ésta es la naturaleza de una interfaz.

Todos los métodos en una interfaz deben ser implementados dentro de la clase; el no cumplir con esta regla resultará en un error fatal. Las clases pueden implementar más de una interfaz si se deseara, separándolas cada una por una coma.

- No pueden tener el mismo nombre que una clase.
- No pueden instanciarse porque no tienen referencias asociadas a objetos.
- No pueden definir propiedades.
- Los métodos de una interfaz deben ser públicos, sólo estar definidos y sin cuerpo.
- Las clases que implementan una interfaz deben utilizar todos los métodos de la misma.
- Diferentes interfaces no pueden tener nombres de métodos idénticos si serán implementadas por una misma clase.

```php
<?php

interface InterfaceA {
	public function un_metodo_publico();
}

interface InterfaceB {
	public function otro_metodo_publico();
}

class NombreDeMiClase implements InterfaceA, InterfaceB {
	/* esta clase implementa todos los métodos
		de la Interfaces invocadas */
}
```

---
## DIFERENCIA ENTRE INTERFACES Y CLASES ABSTRACTAS

Las clases abstractas, no dejan de ser **clases**, las cuales representan la **abstracción de un objeto** siguiendo un orden de **relación jerarquíca** entre ellas.

> Clase B hereda de Clase A y
Clase C hereda de Clase B,
pero no puede tener herencias múltiples,
es decir no puede heredar de más de una clase,
ya que guardan una relación de orden jerárquico entre sí

Las interfaces son solo un **conjunto de métodos característicos de diversas clases**, independientemente de la relación que dichas clases mantengan entre sí.  
Una misma clase, puede implementar múltiples interfaces

---
## 'final'

Las propiedades no pueden declararse como final. **Sólo pueden las clases y los métodos.**

### Clases final

NO pueden ser heredadas por otra. Se definen anteponiendo la palabra clave final.

```php
<?php
final class BaseClass {
   public function test() {
       echo "llamada a BaseClass::test()\n";
   }

   // Aquí no importa si definimos una función como final o no
   final public function moreTesting() {
       echo "llamada a BaseClass::moreTesting()\n";
   }
}

class ChildClass extends BaseClass {
}
// Devuelve un error Fatal: Class ChildClass may not inherit from final class (BaseClass)
?>
```

### Métodos final

Impide que las clases hijas sobrescriban un método, antecediendo su definición con final.

```php
<?php
class BaseClass {
   public function test() {
       echo "llamada a BaseClass::test()\n";
   }
   
   final public function moreTesting() {
       echo "llamada a BaseClass::moreTesting()\n";
   }
}

class ChildClass extends BaseClass {
   public function moreTesting() {
       echo "llamada a ChildClass::moreTesting()\n";
   }
}
// Devuelve un error Fatal: Cannot override final method BaseClass::moreTesting()
?>
```

---
## Constantes de clases

Es posible definir valores constantes en función de cada clase manteniéndola invariable.  
Las constantes se diferencian de las variables comunes en que no utilizan el símbolo $ al declararlas o emplearlas.  
**Mantienen su valor de forma permanente y sin cambios.** A diferencia de las propiedades estáticas, las constantes **solo pueden tener una visibilidad pública**.  
Las constantes de clase están asignadas una vez por clase, y no por cada instancia de la clase.

```php
<?php
class Foo {
    // A partir de PHP 7.1.0
    public const BAR = 'bar';
    private const BAZ = 'baz';
}
echo Foo::BAR, PHP_EOL; // bar
echo Foo::BAZ, PHP_EOL; // Fatal error: Uncaught Error: Cannot access private const Foo::BAZ in …
?>
```

---
## Operador de Resolución de Ámbito (::)

Es un token que permite **acceder a elementos estáticos, constantes, y sobrescribir propiedades o métodos de una clase.**

Ejemplo #1 :: desde el exterior de la definición de la clase

```php
<?php
class MyClass {
    const CONST_VALUE = 'Un valor constante';
}

$classname = 'MyClass';
echo $classname::CONST_VALUE; // A partir de PHP 5.3.0

echo MyClass::CONST_VALUE;
?>
```

Ejemplo #2 :: desde el interior de la definición de la clase

```php
<?php
class OtherClass extends MyClass
{
    public static $my_static = 'variable estática';

    public static function doubleColon() {
        echo parent::CONST_VALUE . "\n";
        echo self::$my_static . "\n";
    }
}

$classname = 'OtherClass';
$classname::doubleColon(); // A partir de PHP 5.3.0

OtherClass::doubleColon();
?>
```

Ejemplo #3 Invocando a un método parent

```php
<?php
class MyClass
{
    protected function myFunc() {
        echo "MyClass::myFunc()\n";
    }
}

class OtherClass extends MyClass
{
    // Sobrescritura de definición parent
    public function myFunc()
    {
        // Pero todavía se puede llamar a la función parent
        parent::myFunc();
        echo "OtherClass::myFunc()\n";
    }
}

$class = new OtherClass();
$class->myFunc();
?>
```

---
## Clases anónimas

En PHP 7 se ha añadido soporte para clases anónimas. Las clases anónimas son útiles cuando es necesario crear objetos sencillos y únicos.

```php
<?php

// Código anterior a PHP 7
class Logger
{
    public function log($msg)
    {
        echo $msg;
    }
}

$util->setLogger(new Logger());

// Código de PHP 7+
$util->setLogger(new class {
    public function log($msg)
    {
        echo $msg;
    }
});
```

Pueden pasar argumentos a través de sus constructores, extender otras clases, implementar interfaces, y utilizar rasgos al igual que una clase normal.

El anidamiento de una clase anónima dentro de otra clase no le proporciona acceso a ningún método o propiedad privados o protegidos de la clase externa. Para utilizar **las propiedades o métodos protegidos de la clase externa, la clase anónima puede extender la clase externa.** Para utilizar las **propiedades privadas de la clase externa en la clase anónima, estos deben pasarse a su constructor:**

```php
<?php

class Externa
{
    private $prop = 1;
    protected $prop2 = 2;

    protected function func1()
    {
        return 3;
    }

    public function func2()
    {
        return new class($this->prop) extends Externa {
            private $prop3;

            public function __construct($prop)
            {
                $this->prop3 = $prop;
            }

            public function func3()
            {
                return $this->prop2 + $this->prop3 + $this->func1();
            }
        };
    }
}

echo (new Externa)->func2()->func3();
```

---
## Iteración de objetos

### 2 formas:

1. A través de bucle **foreach**
     - Ya sea implementando un método dentro de la clase, o fuera de la implementación de la clase iterando sobre la clase. Si iteramos sobre la clase, sólo podremos acceder a las propiedades que son públicas.

```php
<?php
class MiClase
{
    public $var1 = 'valor 1';
    public $var2 = 'valor 2';
    public $var3 = 'valor 3';

    protected $protected = 'variable protegida';
    private   $private   = 'variable privada';

    function iterateVisible() {
       echo "MiClase::iterateVisible:\n";
       foreach ($this as $clave => $valor) {
           print "$clave => $valor\n";
       }
    }
}

$clase = new MiClase();

foreach($clase as $clave => $valor) {
    print "$clave => $valor\n";
}
echo "\n";


$clase->iterateVisible();

?>
```

2. A través de un **Iterador**
     - Creamos una clase que implemente *Iterator*, y luego podemos usar este iterador en cualquier otra clase, implementando *IteratorAggregate*.

```php
<?php
class MiIterador implements Iterator
{
    private $var = array();
    
    public function __construct($array)
    {
        if (is_array($array)) {
            $this->var = $array;
        }
    }

    public function rewind()
    {
        echo "rebobinando\n";
        reset($this->var);
    }

    public function current()
    {
        $var = current($this->var);
        echo "actual: $var\n";
        return $var;
    }

    public function key()
    {
        $var = key($this->var);
        echo "clave: $var\n";
        return $var;
    }

    public function next()
    {
        $var = next($this->var);
        echo "siguiente: $var\n";
        return $var;
    }

    public function valid()
    {
        $clave = key($this->var);
        $var = ($clave !== NULL && $clave !== FALSE);
        echo "válido: $var\n";
        return $var;
    }

}

$valores = array(1,2,3);
$it = new MiIterador($valores);

foreach ($it as $a => $b) {
    print "$a: $b\n";
}
?>

```

La interfaz IteratorAggregate se puede usar como alternativa para implementar todos los métodos de Iterator. IteratorAggregate solamente requiere la implementación de un único método, IteratorAggregate::getIterator(), el cual debería devolver una instancia de una clase que implemente Iterator.

```php
<?php
class MiColección implements IteratorAggregate
{
    private $items = array();
    private $cuenta = 0;

    // Se requiere la definición de la interfaz IteratorAggregate
    public function getIterator() {
        return new MiIterador($this->items);
    }

    public function add($valor) {
        $this->items[$this->cuenta++] = $valor;
    }
}

$colección = new MiColección();
$colección->add('valor 1');
$colección->add('valor 2');
$colección->add('valor 3');

foreach ($colección as $clave => $val) {
    echo "clave/valor: [$clave -> $val]\n\n";
}
?>

```

---
## Métodos mágicos

Será invocado de manera automática, al instanciar un objeto. Su función es la de ejecutar cualquier inicialización que el objeto necesite antes de ser utilizado.

Los nombres de los métodos siguientes son mágicos en las clases PHP:
- __construct(),
```php
<?php

class NombreDeMiClase {

	function __construct() {

	}

} 
```
- __destruct(), 
- __call(), 
- __callStatic(), 
- __get(), 
- __set(), 
- __isset(), 
- __unset(), 
- __sleep() : `public __sleep ( void ) : array`   
El uso para el que está destinado __sleep() consiste en confirmar datos pendientes o realizar tareas similares de limpieza. Además, el método es útil si tiene objetos muy grandes que no necesitan guardarse por completo.  
serialize() comprueba si la clase tiene un método con el nombre mágico __sleep(). Si es así, el método se ejecuta antes de cualquier serialización. Se puede limpiar el objeto y se supone que devuelve un array con los nombres de todas las variables de el objeto que se va a serializar. 
- __wakeup() : `__wakeup ( void ) : void`  
El uso para el que está destinado __wakeup() es restablecer las conexiones de base de datos que se puedan haber perdido durante la serialización y realizar otras tareas de reinicialización.  
Por el contrario, unserialize() comprueba la presencia de un método con el nombre mágico __wakeup(). Si está presente, este método puede reconstruir cualquier recurso que el objeto pueda tener.  
```php
<?php
// uso de __sleep() y __wakeup()
class Connection
{
    protected $link;
    private $dsn, $username, $password;
    
    public function __construct($dsn, $username, $password)
    {
        $this->dsn = $dsn;
        $this->username = $username;
        $this->password = $password;
        $this->connect();
    }
    
    private function connect()
    {
        $this->link = new PDO($this->dsn, $this->username, $this->password);
    }
    
    public function __sleep()
    {
        return array('dsn', 'username', 'password');
    }
    
    public function __wakeup()
    {
        $this->connect();
    }
}?>
```
- __toString() : `public __toString ( void ) : string`  
 El método __toString() permite a una clase decidir cómo comportarse cuando se le trata como un string. Por ejemplo, lo que echo $obj; mostraría. Este método debe devolver un string, si no se emitirá un nivel de error fatal E_RECOVERABLE_ERROR.
```php 
<?php
// Declarar una clase simple
class TestClass
{
    public $foo;

    public function __construct($foo)
    {
        $this->foo = $foo;
    }

    public function __toString()
    {
        return $this->foo;
    }
}

$class = new TestClass('Hola Mundo');
echo $class; // Hola Mundo
?>
```

- __invoke() : `__invoke ([ $... ] ) : mixed`  
El método __invoke() es llamado cuando un script intenta llamar a un objeto como si fuera una función.
```php
<?php
class CallableClass
{
    public function __invoke($x)
    {
        var_dump($x);
    }
}
$obj = new CallableClass;
$obj(5);
var_dump(is_callable($obj)); 
/*
int(5)
bool(true)
?> 
```
- __set_state() : `static __set_state ( array $properties ) : object`  
Este método static es llamado para las clases exportadas por var_export().  
El único parámetro de este método es un array que contiene las propiedades exportadas en la forma array('property' => value, ...).  
- __clone(), 
- __debugInfo() : `__debugInfo ( void ) : array`  
Este método es invocado por var_dump() al volcar un objeto para obtener las propiedades que deberían mostrarse. Si el método no está definido sobre un objeto, se mostrarán todas las propiedades públicas protegidas y privadas.
```php
<?php
class C {
    private $prop;

    public function __construct($val) {
        $this->prop = $val;
    }

    public function __debugInfo() {
        return [
            'propSquared' => $this->prop ** 2,
        ];
    }
}

var_dump(new C(42));
/*
object(C)#1 (1) {
  ["propSquared"]=>
  int(1764)
}
*/
?>
```

---
## Comparando objetos

Al utilizar el operador de comparación (==), se comparan de una forma sencilla las variables de cada objeto, es decir: dos instancias de un objeto son iguales si tienen los mismos atributos y valores (los valores se comparan con ==), y son instancias de la misma clase.

Cuando se utiliza el operador identidad (===), las variables de un objeto son idénticas sí y sólo sí hacen referencia a la misma instancia de la misma clase.

```php
<?php
function bool2str($bool)
{
    if ($bool === false) {
        return 'FALSO';
    } else {
        return 'VERDADERO';
    }
}

function compararObjetos(&$o1, &$o2)
{
    echo 'o1 == o2 : ' . bool2str($o1 == $o2) . "\n";
    echo 'o1 != o2 : ' . bool2str($o1 != $o2) . "\n";
    echo 'o1 === o2 : ' . bool2str($o1 === $o2) . "\n";
    echo 'o1 !== o2 : ' . bool2str($o1 !== $o2) . "\n";
}

class Bandera
{
    public $bandera;

    public function __construct($bandera = true) {
        $this->bandera = $bandera;
    }
}

class OtraBandera
{
    public $bandera;

    public function __construct($bandera = true) {
        $this->bandera = $bandera;
    }
}

$o = new Bandera();
$p = new Bandera();
$q = $o;
$r = new OtraBandera();

echo "Dos instancias de la misma clase\n";
compararObjetos($o, $p);

echo "\nDos referencias a la misma instancia\n";
compararObjetos($o, $q);

echo "\nInstancias de dos clases diferentes\n";
compararObjetos($o, $r);
?>
```

```
Dos instancias de la misma clase
o1 == o2 : VERDADERO
o1 != o2 : FALSO
o1 === o2 : FALSO
o1 !== o2 : VERDADERO

Dos referencias a la misma instancia
o1 == o2 : VERDADERO
o1 != o2 : FALSO
o1 === o2 : VERDADERO
o1 !== o2 : FALSO

Instancias de dos clases diferentes
o1 == o2 : FALSO
o1 != o2 : VERDADERO
o1 === o2 : FALSO
o1 !== o2 : VERDADERO
```

---
## Objetos y referencias

**Una referencia en PHP es un alias, que permite a dos variables diferentes escribir sobre un mismo valor.** Desde PHP 5, una **variable de tipo objeto** ya no contiene el objeto en sí como valor.  
Únicamente **contiene un identificador del objeto que le permite localizar al objeto real, NO EL OBJETO EN SÍ.** Cuando se pasa un objeto como parámetro, o se devuelve como retorno, o se asigna a otra variable, las distintas variables no son alias: guardan una copia del identificador, que apunta al mismo objeto.

### Qué son las referencias

Las Referencias en PHP son medios de acceder al mismo contenido de una variable mediante diferentes nombres.

Observe que en PHP el nombre de la variable y el contenido de la variable son cosas diferentes, por lo que el mismo contenido puede tener diferentes nombres. La analogía más próxima es con los archivos y los nombres de archivos de Unix - los nombres de variables son entradas de directorio, mientras que el contenido de las variables es el archivo en sí. Las referencias se pueden vincular a enlaces duros en sistemas de archivos Unix.

### Valor y referencia

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

### Pasar por Referencia 

Se puede pasar una variable por referencia a una función y así **hacer que la función pueda modificar la variable.** La sintaxis es la siguiente:

```php
function foo(&$var)
{
    $var++;
}

$a=5;
foo($a);
// $a es 6 aquí, sino ponemos &$var, imprime 5
?>
```

---
## Devolver Referencias

Devolver por referencia es útil cuando se quiere usar una función para encontrar a qué variable debería estar vinculada una referencia.

```php
<?php
class foo {
    public $valor = 42;

    public function &obtenerValor() {
        return $this->valor;
    }
}

$obj = new foo;
$miValor = &$obj->obtenerValor(); // $miValor es una referencia a $obj->valor, que es 42.
$obj->valor = 2;
echo $miValor;                // imprime el nuevo valor de $obj->valor, esto es, 2.
?>
```

```php
<?php
class A {
    public $foo = 1;
}  

$a = new A;
$b = $a;     // $a y $b son copias del mismo identificador
             // ($a) = ($b) = <id>
$b->foo = 2;
echo $a->foo."\n";


$c = new A;
$d = &$c;    // $c y $d son referencias
             // ($c,$d) = <id>

$d->foo = 2;
echo $c->foo."\n";


$e = new A;

function foo($obj) {
    // ($obj) = ($e) = <id>
    $obj->foo = 2;
}

foo($e);
echo $e->foo."\n";

?>
/*
2
2
2
*/
```

---
## Serialización de objetos

### serialize()

La función serialize() devuelve un string que contiene un flujo de bytes que representa cualquier valor que se pueda almacenar en PHP.  
Al utilizar serialize para guardar un objeto, almacenará todas las variables de dicho objeto. En cambio los métodos no se guardarán, sólo el nombre de la clase.

### unserialize()

Puede restaurar los valores originales a partir de dicho string.  
Para poder deserializar (unserialize()) un objeto, debe estar definida la clase de ese objeto. Es decir, si se tiene un objeto de la clase A, y lo serializamos, se obtendrá un string que haga referencia a la clase A y contenga todas las variables que haya en esta clase. Si se desea deserializar en otro fichero, antes debe estar presente la definición de la clase A. Esto se puede hacer, por ejemplo, escribiendo la definición de la clase A en un fichero, para después o bien incluirlo, o bien hacer uso de la función spl_autoload_register().

