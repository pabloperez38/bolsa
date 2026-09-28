# Bolsa de Trabajo

Sistema web desarrollado en Laravel para gestionar ofertas laborales, postulaciones y accesos por perfiles institucionales dentro de una bolsa de trabajo universitaria.

## Descripción general

La aplicación permite:

- Publicar y listar ofertas de trabajo y pasantías.
- Registrar candidatos según su tipo: estudiante, graduado o docente.
- Verificar la cuenta por correo electrónico.
- Completar un perfil personal y restringir acceso hasta que esté completo.
- Permitir que empresas gestionen su presencia dentro del sistema.
- Gestionar usuarios y categorías desde un panel administrativo.
- Controlar postulaciones y disponibilidad de cada oferta.

El proyecto está basado en Laravel 12 con una estructura MVC clásica, Vite para assets frontend y configuración real para MySQL en XAMPP/WAMP.

## Roles del sistema

### 1. Administrador

El administrador puede:

- Acceder al panel principal de administración.
- Listar usuarios, ofertas laborales y empresas.
- Gestionar categorías y subcategorías.
- Supervisar la actividad del sistema.

Ruta principal:

- `/admin`

### 2. Empresa

Las cuentas de tipo empresa tienen acceso a una vista específica para consultorios de la organización y su perfil.

Ruta principal:

- `/empresa`

### 3. Candidato

Los usuarios candidatos se registran como:

- estudiante
- graduado
- docente

Estos roles pueden:

- completar su perfil personal,
- navegar ofertas disponibles según el tipo de perfil,
- postularse a trabajos o pasantías,
- consultar su historial de postulaciones,
- retirar postulaciones activas.

Rutas principales:

- `/usuario`
- `/usuario/perfil`
- `/usuario/trabajos`
- `/usuario/pasantias`
- `/usuario/postulaciones`

## Flujo funcional

### Registro de candidato

El candidato debe:

1. Elegir un tipo de usuario: estudiante, graduado o docente.
2. Ingresar DNI y legajo.
3. Validar que esos datos existan en el padrón institucional activo.
4. Registrar un correo y contraseña.
5. Aceptar los términos.

Si coincide con una persona institucional validada, se crea la cuenta y se envía la verificación de correo.

### Verificación de email

El usuario no puede iniciar sesión mientras su email no esté verificado, salvo los administradores.

La verificación se realiza mediante:

- `/email/verificar/{id}/{hash}`

### Perfil completo

Para acceder a funciones de postulaciones, el usuario debe completar su perfil. El middleware `perfil.completo` exige que el perfil contenga datos mínimos como:

- legajo
- dirección
- DNI
- localidad
- teléfono

Si falta información, se redirige a `/usuario/perfil`.

### Postulación

Un usuario puede postularse a una oferta si:

- es estudiante, graduado o docente,
- tiene el perfil completo,
- la oferta está activa,
- la oferta no está vencida,
- la oferta corresponde a su tipo de perfil.

Reglas de acceso por tipo:

- estudiante → solo pasantías
- graduado/docente → solo trabajos

### Retiro de postulación

El usuario puede retirar su inscripción si la postulación todavía está en estado pendiente o en revisión.

## Stack tecnológico

- PHP 8.2
- Laravel 12
- MySQL
- XAMPP
- Vite
- TailwindCSS
- PHPUnit para testing

## Estructura principal

```text
app/
├── Http/
│   ├── Controllers/
│   └── Middleware/
├── Models/
├── Notifications/
└── Providers/
bootstrap/
config/
Database/
├── migrations/
├── seeders/
resources/
├── css/
├── js/
└── views/
routes/
└── web.php
tests/
public/
```

## Rutas principales

Las rutas están definidas en `routes/web.php` y se agrupan por rol:

- Público:
    - `/`
    - `/login`
    - `/register`
    - `/oferta/{slug}/{id}`

- Autenticación:
    - `/registro/candidato`
    - `/registro/empresa`
    - `/logout`
    - `/email/verificar/{id}/{hash}`

- Administración:
    - `/admin`
    - `/admin/usuarios`
    - `/admin/ofertas-laborales`
    - `/admin/empresas`
    - `/admin/categorias`

- Empresa:
    - `/empresa`
    - `/empresa/perfil`

- Usuario:
    - `/usuario`
    - `/usuario/perfil`
    - `/usuario/trabajos`
    - `/usuario/pasantias`
    - `/usuario/postulaciones`

## Instalación

### Prerrequisitos

- PHP 8.2+
- Composer
- Node.js y npm
- MySQL
- XAMPP o un servidor local con MySQL activo
- Git

### Pasos

1. Clonar el proyecto:

```bash
git clone <url-del-repositorio>
cd bolsa-trabajo
```

2. Instalar dependencias de PHP:

```bash
composer install
```

3. Instalar dependencias frontend:

```bash
npm install
```

4. Configurar la base de datos en el archivo `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bolsa-trabajo
DB_USERNAME=root
DB_PASSWORD=
```

5. Crear la base de datos en MySQL si no existe:

```sql
CREATE DATABASE `bolsa-trabajo`;
```

6. Generar la clave de aplicación:

```bash
php artisan key:generate
```

7. Ejecutar migraciones y seeders:

```bash
php artisan migrate --seed
```

8. Levantar el proyecto:

```bash
php artisan serve
```

Y en otra terminal:

```bash
npm run dev
```

## Usuarios semilla

El proyecto incluye usuarios de prueba predefinidos para desarrollo y pruebas locales:

- Administrador: `admin@bolsatrabajo.com` / `12345678`
- Estudiante: `estudiante@bolsatrabajo.com` / `12345678`
- Graduado: `graduado@bolsatrabajo.com` / `12345678`
- Docente: `docente@bolsatrabajo.com` / `12345678`
- Empresa: `empresa@bolsatrabajo.com` / `12345678`

> Estos usuarios son útiles para verificar permisos y flujos por rol.

## Base de datos y datos maestros

El seeder principal carga los siguientes registros:

- categorías y subcategorías
- empresas
- tipos de usuario
- usuarios base
- localidades
- tipos de oferta
- modalidades
- tipos de contratación
- trabajos
- personas institucionales

## Seguridad y validaciones

El sistema aplica capas de validación y control de acceso mediante middleware:

- `admin` → restringe acceso a administradores
- `empresa` → restringe acceso a empresas
- `usuario` → restringe acceso a candidatos
- `perfil.completo` → obliga completar datos mínimos antes de acceder a funciones del usuario

Además, la autenticación válida email verificado para usuarios no administradores y el registro de candidatos valida la existencia institucional.

## Verificación del proyecto

Se validó el comportamiento principal con:

```bash
php artisan test --filter=RoleAccessTest
```

Resultado verificado:

- 4 pruebas pasadas
- 0 fallas

Esto confirma que el sistema de permisos por rol y accesos principales está funcionando correctamente con la configuración actual.

## Licencia

Este proyecto se distribuye bajo la licencia MIT, en línea con el esqueleto base de Laravel.
