# Clase

Es una **definición** de los datos y funcionalidades de elementos de un tipo.

### Clase Coche:

- Datos: modelo, año fabricación, cilindrada...
- Funcionalidades: arrancar, frenar, acelerar...

### Clase Carrito_de_compra:

- Datos: productos del carrito, descuentos, importe...
- Funcionalidades: añadir producto, quitar producto...


# Objeto

Es un **ejemplar**, una unidad de un elemento con las características definidas de una clase. **Instancia**.

### Objetos Coche:

- Volkswagen Golf del 2010 2.0 TDI, negro, 5 puertas...
- Mini de 1978, 0.9 gasolina, rojo, 3 puertas...

**Ambos responden a las mismas operaciones:**
- Arrancar, parar, acelerar, frenar...

# Atributo (propiedad)

Un dato dentro de una clase. Son los datos descritos en la clase.

- Todos los objetos de una clase tienen todos los atributos definidos en la clase. 
- Pueden ser constantes o variables.
- *Todos los coches tienen 4 ruedas, pero distintos colores.*

# Estado

Son los valores que tienen los atributos en un momento dado.

Los valores pueden cambiar a lo largo del tiempo, pudiendo tener diferentes estados a lo largo de la vida del objeto.


# Mensaje

Es una **invocación de la funcionalidad** de un objeto. "Lanzamos mensajes" para pedir a los objetos que realicen acciones para nosotros.

*A un objeto coche concreto le lanzo el mensaje 'acelera'. Algunos mensajes tienen que producirse cuando me piden que haga algo.*

# Método

Es la **definición de una operación de una clase**. Los declaras dentro del código de la propia clase.

El método contiene el código que debe ejecutarse cuando le pasan un mensaje.

Es una función que dice qué operaciones tienen que producirse cuando me piden que haga algo.

# Conceptos de POO

Una **clase** es una definición de los **métodos** y **atributos** de un conjunto de objetos homogéneo.

Un **objeto** es un ejemplar de una **clase**, que tiene como datos los **atributos** definidos en la clase, con unos **estados** determinados en cada instante, y responde a **mensajes** ejecutando el código definido en los **métodos.**

# Instanciación

Es el proceso por el cual se crea un ejemplar (objeto) a partir de una clase.

- Se pueden crear *N* objetos a partir de una clase
- Durante el proceso de instanciación puede (y generalmente es así) realizarse una invocación a un método especial denominado 'constructor'.

```php
$freelance = new Freelance();
// freelance es una variable con una REFERENCIA a un objeto de la clase Freelance
```

# Variable $this

Referencia al objeto que recibió el mensaje cuyo método se está programando.

# Vista pública / privada

La encapsulación hace que de una clase puedas exponer unas cosas u otras para que sean conocidas en el exterior.

> Encapsulación: es el proceso por el que se ocultan (deliberadamente) las características de algo.

### Vista pública

Aquellas operaciones (o datos) que la clase expone para que los demás 'trabajen' con ella.

Dice lo que yo podré hacer.

### Vista privada

Es la implantación de esas operaciones y los datos que necesitas para poder realizarlas.

Es cómo hago las cosas, que está encapsulada.

- public
  - Podremos acceder desde todas las partes
  
- private
  - Acceso únicamente en la vista privada

- protected
  - private + acceso en clases hijas.