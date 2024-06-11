# Angular-Simple-CRUD-API

Este proyecto contiene los archivos para una API CRUD simple de empleados. Incluye los siguientes archivos:

- `employee.php`: Archivo que maneja las operaciones CRUD para los empleados.
- `db.php`: Archivo que maneja la conexión a la base de datos.
- `employee_db.sql`: Archivo SQL para la creación y población de la base de datos de empleados.

## Requisitos

Para ejecutar este proyecto, necesitas tener instalados los siguientes componentes:

- Servidor web local (por ejemplo, XAMPP, WAMP, MAMP)
- PHP 7.4 o superior
- MySQL 5.7 o superior

## Instalación

Sigue estos pasos para configurar y ejecutar el proyecto en tu servidor local.

### 1. Configurar el servidor web local

1. Si no tienes un servidor web local, descarga e instala uno:
   - [XAMPP](https://www.apachefriends.org/index.html)
   - [WAMP](http://www.wampserver.com/en/)
   - [MAMP](https://www.mamp.info/en/)

2. Inicia el servidor web y asegúrate de que los servicios de Apache y MySQL estén en ejecución.

### 2. Configurar la base de datos

1. Abre phpMyAdmin o cualquier herramienta de gestión de bases de datos de tu elección.
2. Crea una nueva base de datos llamada `employee_db`.
3. Importa el archivo `employee_db.sql` a la base de datos recién creada. Este archivo contiene las tablas y datos necesarios para la aplicación.

### 3. Configurar los archivos del proyecto

1. Clona el repositorio del proyecto o descarga los archivos en el directorio raíz de tu servidor web local. Por ejemplo, en XAMPP, coloca los archivos en el directorio `C:\xampp\htdocs\Angular-Simple-CRUD-API`.

2. Abre el archivo `db.php` y configura los parámetros de conexión a la base de datos según tu entorno:
   ```php
   <?php
   $host = 'localhost';
   $db_name = 'employee_db';
   $username = 'tu_usuario';
   $password = 'tu_contraseña';
   $conn;

   try {
       $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   } catch(PDOException $exception) {
       echo "Connection error: " . $exception->getMessage();
   }
   ?>
   
### 4. Probar la API

1. Abre tu navegador web y navega a `http://localhost/Angular-Simple-CRUD-API/employee.php`.
2. Utiliza herramientas como [Postman](https://www.postman.com/) para probar los endpoints de la API y realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar) en la base de datos de empleados.

## Uso

Una vez configurado, puedes utilizar la API para gestionar los empleados mediante solicitudes HTTP. Aquí tienes algunos ejemplos de los endpoints disponibles:

- `GET /employee.php`: Obtiene una lista de todos los empleados.
- `POST /employee.php`: Crea un nuevo empleado.
- `PUT /employee.php`: Actualiza un empleado existente.
- `DELETE /employee.php`: Elimina un empleado.

---

Este readme proporciona una guía clara y estructurada para instalar y utilizar la API de empleados en un entorno local. Si tienes alguna pregunta o necesitas asistencia adicional, no dudes en contactarnos.

