# Bolsa de Trabajo Universitaria

Aplicación web universitaria destinada a la publicación de ofertas laborales y pasantías, la gestión de postulaciones y la vinculación entre estudiantes, graduados, docentes y empresas.

Desarrollada con **Laravel 12, PHP y MySQL/MariaDB**, con autenticación, control de acceso por roles y validación de candidatos mediante un padrón institucional.

## Funcionalidades

- Catálogo público de ofertas laborales y pasantías.
- Registro y autenticación de usuarios.
- Validación institucional de estudiantes, graduados y docentes.
- Registro y gestión del perfil de empresas.
- Inicio de sesión mediante Google OAuth.
- Verificación de correo electrónico.
- Autenticación en dos pasos (2FA) mediante códigos TOTP.
- Recuperación y restablecimiento de contraseñas mediante Laravel Fortify.
- Perfiles de candidatos con datos personales, información profesional, fotografía y CV.
- Gestión del historial de postulaciones.
- Panel administrativo para consultar usuarios, ofertas y empresas.
- Administración de categorías con eliminación lógica y restauración.

## Roles de usuario

| Rol | Funcionalidades principales |
|---|---|
| Administrador | Consulta y administración de información general y categorías. |
| Empresa | Consulta de sus publicaciones y actualización de sus datos. |
| Estudiante | Consulta y postulación a pasantías. |
| Graduado | Consulta y postulación a ofertas laborales. |
| Docente | Consulta y postulación a ofertas laborales. |

El acceso a las distintas funcionalidades se controla mediante autenticación, roles y reglas de autorización del servidor.

## Tecnologías

- PHP 8.2 o superior.
- Laravel 12.
- Laravel Fortify.
- Laravel Socialite.
- MySQL/MariaDB.
- JavaScript.
- Vite.
- Tailwind CSS.
- PHPUnit.

## Requisitos

Para ejecutar el proyecto en un entorno local se necesita:

- PHP con las extensiones requeridas por Laravel.
- Composer.
- Node.js y npm.
- MySQL o MariaDB, por ejemplo mediante XAMPP.
- Git.

## Instalación local

### 1. Clonar el repositorio

```bash
git clone <URL_DEL_REPOSITORIO>
cd bolsa-trabajo
```

### 2. Instalar dependencias

```bash
composer install
npm install
```

### 3. Configurar el entorno

Crear el archivo `.env` a partir del ejemplo:

```bash
cp .env.example .env
```

En PowerShell también se puede ejecutar:

```powershell
Copy-Item .env.example .env
```

Configurar las variables de entorno según la instalación local, especialmente la conexión a la base de datos, la URL de la aplicación y el servicio de correo.

**No publicar el archivo `.env` ni incorporar credenciales reales al repositorio.**

### 4. Generar la clave de la aplicación

```bash
php artisan key:generate
```

### 5. Crear y preparar la base de datos

Crear una base de datos vacía en MySQL/MariaDB y configurar sus datos de conexión en `.env`.

Luego ejecutar:

```bash
php artisan migrate --seed
```

Este comando ejecuta las migraciones y carga los datos iniciales definidos por el proyecto.

> Atención: `php artisan migrate:fresh --seed` elimina las tablas existentes antes de reconstruir la base de datos. Utilizarlo únicamente cuando se pueda perder la información almacenada.

### 6. Preparar el almacenamiento

```bash
php artisan storage:link
```

### 7. Iniciar la aplicación

En una terminal:

```bash
php artisan serve
```

En otra terminal:

```bash
npm run dev
```

Abrir en el navegador la dirección local indicada por Laravel, habitualmente `http://127.0.0.1:8000`.

## Configuración adicional

### Google OAuth

Para habilitar el inicio de sesión con Google, configurar las credenciales correspondientes en `.env`:

```env
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback
```

La URL de retorno debe coincidir con la registrada en la configuración de Google. Las credenciales reales deben mantenerse fuera del repositorio.

### Correo electrónico

Configurar un servicio de correo compatible con Laravel para enviar mensajes de verificación y recuperación de contraseñas.

En desarrollo se puede utilizar el controlador de correo de registro (`log`) si así está configurado el entorno. En ese caso, los mensajes se escriben en los registros de la aplicación en lugar de enviarse por correo.

## Seguridad

El proyecto contempla mecanismos de autenticación y autorización, verificación de correo electrónico, control de acceso por roles y autenticación en dos pasos opcional.

Para mantener un despliegue seguro:

- No publicar contraseñas, claves API, tokens ni secretos OAuth.
- No incluir datos personales reales del padrón institucional.
- No utilizar credenciales de desarrollo en producción.
- Configurar `APP_DEBUG=false` en producción.
- Utilizar HTTPS en el entorno publicado.
- Mantener las dependencias actualizadas.
- Verificar los permisos de acceso a los archivos y a las funcionalidades administrativas.

## Pruebas y compilación

Ejecutar las pruebas automatizadas:

```bash
php artisan test
```

Compilar los recursos del frontend:

```bash
npm run build
```

## Estado del desarrollo

La aplicación cuenta con funcionalidades de autenticación, gestión de perfiles, consulta de ofertas, postulaciones y administración de categorías.

Entre los aspectos que pueden requerir ampliaciones se encuentran:

- Operaciones completas para crear, editar y administrar ofertas laborales y pasantías.
- Ampliación de las herramientas de administración.
- Integración y pruebas completas de autenticación mediante Passkeys.
- Ampliación de las pruebas automatizadas de los flujos de negocio.

La disponibilidad concreta de cada funcionalidad depende de su implementación y configuración en la versión del proyecto.

## Licencia

Definir la licencia del proyecto según las condiciones institucionales y los derechos de distribución correspondientes.