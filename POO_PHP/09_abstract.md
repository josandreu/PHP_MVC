# Abstracción

En PHP tenemos clases y métodos abstractos.

- Una clase que tiene uno o más métodos abstracto debe ser definida como abstracta
- Una clase que es abstracta significa que no podemos instanciar objetos de esta clase

> La clase Mamifero debería ser abstract, ya que no tiene sentido que instanciemos
> un objeto 'mamifero'. Lo normal es que tengamos una clase Perro, Elefante, Gato
> que heredarán de Mamifero y serán las que instanciemos

## Clases abstractas

- Cuando tenemos un método abstracto, por lo tanto la clase debe definirse como abstracta.
- Cuando no se trata de una clase indicada para instanciar obejtos de la misma.

```php
abstract class Persona
{
    // Podemos definir propiedades y métodos como en cualquier clase
    // ...
    // Además podemos definir métodos abstractos
```

## Métodos abstractos

Un método abstracto simplemente se muestra su cabecera, no tiene código.

```php
abstract class Persona
{
   public abstract function hablar();
}
```
