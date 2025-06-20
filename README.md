

Para la realización de este proyecto decidí implementar el backend utilizando el framework Laravel junto con Vue.js para el frontend.

Aunque inicialmente no tenía experiencia con estos frameworks, tras investigar un poco sobre sus características y compatibilidad, opté por usar Vue.js debido a su integración nativa con Laravel.

Implementé la autenticación básica utilizando Laravel Breeze, aprovechando el modelo de usuario que incluye por defecto. Además, integré Vue.js mediante Inertia.js, lo que permite desarrollar la aplicación como un único proyecto full-stack de forma fluida y eficiente.

## Configurar Autenticación Básica
Sigue estos pasos para configurar una autenticación básica con Laravel Breeze e Inertia.js + Vue:

1. Requisitos previos
Asegúrate de tener instalados:

Composer
Node.js y npm

2. Crear un nuevo proyecto de Laravel

```bash
composer create-project --prefer-dist laravel/laravel nombre_del_proyecto
```
3. Acceder al directorio del proyecto
```bash
cd nombre_del_proyecto
```
4. Agregar Laravel Breeze
```bash
composer require laravel/breeze --dev
```
5. Instalar Breeze
```bash
php artisan breeze:install
```
Durante la instalación, selecciona Inertia + Vue como stack frontend.
6. Instalar dependencias de Node.js
```bash
npm install
```
7. Levantar los servidores de desarrollo
```bash
php artisan serve
```
En otra terminal:
```bash
npm run dev
```
Nota:
Puedes ejecutar las migraciones con:

```bash
php artisan migrate
```
Sin embargo, aún no se ha configurado el archivo .env ni editado las migraciones ni el modelo de datos para añadir información adicional al usuario.

## CRUD Gestión de Usuarios

1. Configurar el .env para este proyecto opte por utilizar Mysql.

con los siguientes dAtos de conexion 
```bash

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=user_management
DB_USERNAME=root
DB_PASSWORD=

```

2. El modelo "User" que inclueye Laravel Brezze por defecto, ya incluye por defecto los campos de:  

    'name'
    'email'
    'password'

editare el modelo y la migracion para agregar de telefono y apellido, aprovechando al maximo las herramientas que nos brinda la starte key.

    'name'
    'lastName'
    'email'
    'password'
    'number_phone'

