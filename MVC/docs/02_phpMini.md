[MINI](https://github.com/panique/mini)

Es un esqueleto para crear una aplicación web con lo mínimo necesario para empezar. Está pensado para elevar la calidad de los proyectos que realizarás a partir de él, pero sin entrar en la complejidad de un framework ni obligarte a hacer las cosas únicamente de una manera

## Instalación Vagrant 100% automática

1. Crea una carpeta nueva, en el directorio de tus proyectos. No tiene por qué estar dentro de .htdocs, de hecho no te recomendaría ponerlo dentro de una carpeta de apache.

2. Copia Vagrantfile y bootstrap.sh en esa carpeta. Vagrantfile contiene instrucciones para la creación de la máquina virtual y bootstrap.sh es un script bash con código, en el que encontrarás los comandos que se necesitan para que, desde un servidor recién instalado, se instalen todos los paquetes necesarios y se configuren, con el código de la aplicación incluido.

3. En un terminal, entras en la carpeta que has creado y lanzas el comando: `vagrant box add puphpet/ubuntu1404-x64`. Eso te crea una "box" de Vagrant con Ubuntu 14.04 a 64bit. Ese comando te descarga esa box y solo lo tienes que hacer si no la habías descargado antes.

4. En la misma carpeta, lanzas el comando: `vagrant up`. Eso ejecutará tu "box" y comenzará a instalar toda la serie de paquetes que se han definido, incluidos todos los comandos que encuentras en bootstrap.sh.

## Estructura de carpetas

`application`  
El directorio "application" contiene los archivos de la aplicación. **Todos son archivos con código PHP que realmente no necesita, ni debería, estar expuesto en el directorio raíz de Apache, por temas obvios de seguridad.**

Carpeta application:

- config, archivo de configuración
- controller, archivos con el código de los controladores
- core, archivos núcleo de la aplicación, está la clase application (controlador frontal, sistema
  de ruteo) y la clase de la que deben heredar todos los controladores "Controller".
- libs, una sugerencia de carpeta donde poner tus propias librerías, de momento solo le han
  colocado un archivo con una clase llamado helper.php \*
- model, donde se colocan los modelos
- view, donde se colocan las vistas
  - \_templates, donde ha puesto cabecera y pie
  - una carpeta para cada controlador
  - las plantillas de ese controlador

> \* Advierte en que en la clase helper de helper.php tenemos un único método estático (están usando la clase como un mero contenedor de funciones).

`public`  
La carpeta "public" contiene los assets de la aplicación (imágenes, hojas de estilo, etc.) que necesita tu web para funcionar. **Este es el único directorio que debería estar disponible desde las carpetas de publicación de Apache, dentro de htdocs o como se llame el "document root". Si te creas un virtualhost, public debería ser la carpeta raíz del host virtual.**

Carpeta public:

- .htaccess, configuración para rutear todas las URL
- css
- img
- index.php (es el único archivo de la aplicación, donde se reciben todas las
  peticiones que se realicen. Llegan todas aquí por la regla producida en el .
  htaccess.
- js
