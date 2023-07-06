# ptKonecta
Es un software para la administración y registro de ventas he inventarios para las cafeterías de Konecta.
## Requisitos del sistema
- Servidor con PHP (versión 8.2.4 o superior) y MySQL (versión 8.0 o superior).
- 1GB RAM
- Espacio en disco: 36,0 KB
## Inicio Rápido
Para instalar este programa en un entorno de producción se debe clonar el repositorio siguiendo la configuración y distribución del servidor, este debe contar con PHP (versión 8.2.4 o superior) y MySQL (versión 8.0 o superior) para lo cual se recomienda seguir las instrucciones según el soporte de los respectivos softwares, de acuerdo con las características técnicas, los cuales los puede encontrar en:
- PHP: https://www.php.net/manual/en/install.php
- MySQL: https://dev.mysql.com/doc/

Una vez instalado modifique las variables en el módulo config.php para conectar el aplicativo a la base de datos y acceda a la ruta raíz para empezar a interactuar con el aplicativo web.

## Para desarrolladores:
### Instalación 
Se Puede realizar las pruebas en su entorno y/o servidor de desarrollo preferido, para realizar un ejemplo practico se realiza la explicación realizando el despliegue en el servidor XAMPP.
- Si no lo tiene instale XAMP versión 8.2.4 o superior
- Ingrese a la carpeta donde instalo XAMPP (si no escogió una ruta distinta y usa Windows lo podrá encontrar en C:\xampp)
- Abra la carpeta htdocs
- Realice en esa carpeta una copia del repositorio

### Arquitectura
El programa es un aplicativo web el cual usa en el front end HTML, CSS, JS y para el back end PHP, con la estructura MVC.
### Módulos
- bd.sql: Contiene el código fuente para la creación de la base de datos.
- checkers.php: Este es un pequeño modulo para verificar y estandarizar la información recibida en el servidor.
- config.php: Acá se encuentran las variables de acceso necesarias para conectar a la base de datos.
- dbModels.php: Acá se crean los modelos para las consultas a la base de datos.
- delete.php: Este es el módulo encargado de controlar la eliminación de los productos y proyectar la vista correspondiente al usuario.
- index.php: Este es el módulo encargado de controlar la creación y despliegue de los productos en la base de datos y proyectar la vista correspondiente al usuario.
- template.php: En este modulo se crean las plantillas del cabezote y pie de página de la aplicación que ve el usuario.
- update.php: Este es el módulo encargado de controlar la actualización de los productos y proyectar la vista correspondiente al usuario.
- sales.php: Este modulo realiza las ventas verificando que sea posible según el Stock además de mostrar el producto más vendido y el que tiene mayor stock.

Para más información el código está documentado.