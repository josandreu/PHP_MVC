# Qué es MVC

Es un PATRÓN DE DISEÑO para desarrollo de software.

- No es específico de PHP
- Se usa sobretodo en aplicaciones con interfaces de usuario
- Usado por la mayoría de los frameworks
- Popularizado especialmente en desarrollo web.

## Por qué MVC?

Porque aporta ventajas en el desarrollo y sobretodo en su ciclo de vida.

## Separación de responsabilidades

- Claridad, entendemos mejor cada una de las partes del sistema
- Escalabilidad
- Desacoplamiento, si una parte cambia no afecta demasiado a otras partes del sistema.

## Programación por capas

Dividimos el código de nuestro software en diversas partes, atendiendo a su responsabilidad:

- Cada 'capa' se encarga de hacer una parte concreta del trabajo de la app.

Obtenemos los mismo beneficios:

- Claridad, escalabilidad, desacoplamiento.

# MVC al detalle

**Modelo, Vista, Controlador** son las capas que propone este patrón de diseño de software.

## Modelo

Trabaja con los DATOS de la aplicación.

Mantiene los datos de la aplicación.

- Conoce la estructura de los datos.
- Define las cosas que se pueden y no se pueden hacer con los datos.
- Conoce y aplica las reglas que deben seguirse para el tratamiento de los datos (lógica de negocio).

_El modelo conoce todas esas operaciones con los datos, las define y es capaz de procesarlas, pero no sabe cuando debe hacerlo. Alguien tiene que ordenarle que las haga._

## Vista

Representa la INFORMACIÓN y la INTERFAZ de usuario.

Es la encargada de presentar la información y los controles para interactuar con la aplicación.

- Toda salida (output) debe realizarse desde una vista.
- Debemos proporcionarle QUÉ datos se deben mostrar.
- La vista solo sabe CÓMO debe mostrarlos.

_Cada una de las pantallas de una app podría corresponder con una vista. La vista escribe esa pantalla, representando la info necesaria._  
_La vista no sabe de donde ha sacado los datos para rellenar esa pantalla, solo sabe de qué manera deben representarse._

## Controlador

COORDINA la aplicación, trabaja con modelos y las vistas. (Vistas y modelos no se conocen entre sí).

Se encarga de comunicar los modelos y las vistas.

MODELO --> CONTROLADOR --> VISTA

Se coloca entre medias de los modelos y las vistas para coordinar las acciones a realizar en una app. Él sabe cuando pedir a los modelos hacer las operaciones y también conoce y acciona a las vistas que deben representar las pantallas de la aplicación.

- Encargado de realizar las acciones necesarias para desempeñar las tareas de una aplicación.
- Interactuar con los modelos y las vistas.
- Gobierna la aplicación.

El controlador es capaz de saber a qué modelos debe llamar para procesar los datos y sabe a qué vistas debe invocar para producir la salida.  
Por eso se doce a beves que en él reside la LÓGICA DE LA APP.

## En el contexto de una app web

### Modelo

Realizará las operaciones con la base de datos, consultas, actualizaciones, inserciones.  
Validarán si aquelos datos que se vana insertar son correctos y válidos para el negocio. (Ojo, los datos pueden venir de cualquier lugar, como una API).

### Vista

Escribe el HTML para mostrar los datos.  
Será típicamente HTML, pero también podría haber vistas que generan formatos en otras salidas.

### Controlador

Recibirá las peticiones por medio de URL u operaciones POST y realizará las operaciones necesarias para poder procesar esas peticiones.  
Desde un controlador puede ser necesario llamar a más de un modelo o más de una vista.

```
Petición  -----▶  Sistema de enrutado (se invoca el controlador adecuado para procesar esta petición)
(Cliente)                 |
      ▲                   |
      |                   |
      |                   ▼
    Vista   ◀-----   Controlador (pide datos al modelo adecuado y el modelo los devuelve)
(El controlador usa       ▲
la vista adecuada         |
para representar          |
la info, enviando         ▼
los datos necesarios)   Modelo

```

## Sistema de enrutado

Todo comienza con la solicitud de una página:

- El sistema de enrutado permite seleccionar el controlador adecuado para cada dirección.

Ejemplo de url: example.com/motor/resultados/gp-singapur/alonso

> **motor**: controlador que se utilizará (CLASE)  
> **resultados**: acción (MÉTODO)  
> **gp-singapur/alonso**: datos adicionales (PARÁMETROS DEL MÉTODO)

Todas las url se suelen procesar por el mismo archivo, generalmente el `index.php`

En `index.php` la url se decompone y se analiza para dirigir la solicitud hacia el controlador adecuado, ejecutar la acción solicitada en él y enviando los parámetros indicados.

- No necesitamos crear físicamente archivos, ni carpetas para procesar las solicitudes
- Tenemos un lugar donde pasa el código de cualquier solicitud y podemos hacer cosas globales a toda la aplicación
- Somos capaces de gestionar los errores de la app desde PHP
