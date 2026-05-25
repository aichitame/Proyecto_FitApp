# FitApp

FitApp es una aplicación web desarrollada como Trabajo de Fin de Grado del ciclo de Desarrollo de Aplicaciones Web. Su finalidad es gestionar solicitudes de planes orientativos de alimentación y actividad física.

La aplicación permite que un usuario cliente se registre, acceda a su área privada y complete una solicitud con sus datos básicos, hábitos, actividad física y objetivos personales. Posteriormente, un usuario administrador puede revisar dicha solicitud desde el panel de administración, crear un plan orientativo asociado, publicarlo y notificar al cliente por correo electrónico cuando esté disponible.

## Funcionalidades principales

- Registro e inicio de sesión de usuarios.
- Diferenciación de roles entre cliente y administrador.
- Área privada para el usuario cliente.
- Formulario de solicitud de plan orientativo.
- Consulta del estado de las solicitudes.
- Histórico de solicitudes del cliente.
- Panel de administración con Filament.
- Gestión de solicitudes desde el panel de administración.
- Creación y edición de planes orientativos.
- Publicación de planes para el cliente.
- Envío de notificaciones por correo electrónico.
- Diseño responsive adaptado a escritorio y móvil.

## Tecnologías utilizadas

- PHP 8.4
- Laravel 12
- Livewire
- Livewire Volt
- Flux UI
- Filament
- Spatie Laravel Permission
- Blade
- MySQL
- Vite
- Composer
- npm
- Git y GitHub

## Requisitos previos

Para ejecutar el proyecto en local es necesario disponer de:

- PHP 8.4 o superior
- Composer
- Node.js y npm
- MySQL o una base de datos compatible
- Extensión PHP intl
- Extensión PHP zip

## Instalación

Clonar el repositorio:

```bash
git clone https://github.com/aichitame/Proyecto_FitApp
cd Proyecto_FitApp
```

Instalar dependencias de PHP:

```bash
composer install
```

Instalar dependencias de JavaScript:

```bash
npm install
```

Copiar el archivo de entorno:

```bash
cp .env.example .env
```

Generar la clave de la aplicación:

```bash
php artisan key:generate
```

Configurar la conexión a la base de datos en el archivo `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fitapp
DB_USERNAME=root
DB_PASSWORD=
```

Ejecutar migraciones y seeders para preparar la base de datos con los datos iniciales necesarios para probar la aplicación:

```bash
php artisan migrate
```

## Ejecución en local

Levantar el servidor de Laravel:

```bash
php artisan serve
```

Compilar los recursos frontend:

```bash
npm run dev
```

También puede utilizarse el comando de desarrollo definido en Composer:

```bash
composer dev
```

Este comando ejecuta de forma conjunta el servidor de Laravel, la cola de trabajos, los logs y Vite en modo desarrollo.

## Accesos principales

Una vez levantado el proyecto en local, se puede acceder a la aplicación desde:

http://127.0.0.1:8000

Panel de administración:

http://127.0.0.1:8000/admin

Área privada del cliente:

http://127.0.0.1:8000/dashboard

## Usuarios de prueba

Después de ejecutar las migraciones y seeders, se pueden utilizar los siguientes usuarios de prueba:

### Administrador

```text
Email: admin@fitapp.com
Password: Admin123!
```

### Cliente

```text
Email: client@test.com
Password: Client123!
```

## Roles de usuario

La aplicación diferencia dos perfiles principales:

### Cliente

El usuario cliente puede registrarse, iniciar sesión, enviar una solicitud de plan orientativo, consultar el estado de sus solicitudes y acceder al plan publicado desde su área privada.

### Administrador

El usuario administrador accede al panel de administración, donde puede revisar solicitudes, cambiar estados, crear y editar planes orientativos, publicarlos y gestionar el envío de notificaciones.

## Flujo principal

1. El cliente se registra en la aplicación.
2. El cliente inicia sesión en su área privada.
3. El cliente completa el formulario de solicitud.
4. El sistema registra la solicitud en estado pendiente.
5. El administrador revisa la solicitud desde el panel de administración.
6. El administrador crea o edita el plan orientativo asociado.
7. El administrador publica el plan.
8. El sistema notifica al cliente por correo electrónico.
9. El cliente consulta el plan publicado desde su área privada.

## Correos electrónicos

FitApp utiliza el sistema de correo de Laravel para enviar notificaciones al cliente cuando su plan orientativo ha sido publicado.

La configuración debe realizarse en el archivo `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.example.com
MAIL_PORT=587
MAIL_USERNAME=usuario@example.com
MAIL_PASSWORD=contraseña
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=no-reply@fitapp.com
MAIL_FROM_NAME="FitApp"
```

Las credenciales reales no deben subirse al repositorio.

## Pruebas

Para ejecutar las pruebas automatizadas disponibles en el proyecto:

```bash
php artisan test
```

También puede utilizarse:

```bash
composer test
```

Además de las pruebas automatizadas, durante el desarrollo se han realizado pruebas funcionales manuales sobre las principales partes de la aplicación: registro de usuarios, autenticación, creación de solicitudes, gestión desde el panel de administración, publicación de planes, envío de notificaciones por correo electrónico y adaptación responsive.

Estas pruebas han permitido comprobar que el flujo principal de FitApp funciona correctamente desde el punto de vista del cliente y del administrador.

## Despliegue

El proyecto está preparado para su despliegue en un entorno externo. En este caso, se ha utilizado Railway como plataforma de publicación, configurando previamente las variables de entorno necesarias para la aplicación, la base de datos y el envío de correos electrónicos.

Las variables sensibles, como credenciales de base de datos o contraseñas de correo, deben configurarse en el entorno de despliegue y no deben subirse al repositorio.

En un entorno de producción, se recomienda ejecutar:

```bash
composer install --no-dev --optimize-autoloader
npm install
npm run build
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Entre las variables de entorno principales se encuentran:

```env
APP_NAME=FitApp
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=

DB_CONNECTION=mysql
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME="FitApp"
```

La configuración concreta puede variar según el entorno utilizado, pero el objetivo del despliegue es permitir que FitApp pueda ejecutarse fuera del entorno local y ser accesible para su revisión y presentación.

## Estado actual del proyecto

El proyecto cuenta con una base funcional completa para revisar el flujo principal de FitApp desde el punto de vista del cliente y del administrador.

Actualmente se puede probar el registro de usuarios, el acceso al área privada, la creación de solicitudes, la revisión desde el panel de administración, la creación y publicación de planes orientativos y el envío de notificaciones por correo electrónico.

## Consideraciones importantes

FitApp tiene carácter exclusivamente orientativo. Los planes generados no constituyen una herramienta médica ni sustituyen el asesoramiento, diagnóstico o tratamiento realizado por profesionales sanitarios.

El sistema está diseñado para gestionar solicitudes y planes informativos relacionados con hábitos de alimentación y actividad física, respetando la privacidad de los datos introducidos por el usuario.

## Autoría

Proyecto desarrollado por Aixa Márquez Evdenic como Trabajo de Fin de Grado del ciclo de Desarrollo de Aplicaciones Web.


