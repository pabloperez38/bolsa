# Bolsa de Trabajo

Aplicación web universitaria para publicar ofertas laborales y pasantías, validar candidatos con un padrón institucional y administrar postulaciones. Está construida con Laravel 12 y PHP 8.2 o superior.

## Funcionalidades implementadas

- Catálogo público de ofertas activas, filtros de navegación por tipo de usuario, página de detalle autenticada y ofertas relacionadas por categoría y empresa.
- Registro de estudiantes, graduados y docentes mediante validación de DNI, legajo, tipo y estado activo en el padrón institucional.
- Registro de empresas mediante CUIT y correo únicos.
- Inicio de sesión con contraseña o Google OAuth, verificación de correo para cuentas no administrativas y cierre de sesión.
- Autenticación en dos pasos (TOTP) opcional para cuentas de candidato, con códigos de recuperación.
- Restablecimiento de contraseña mediante las acciones y rutas de Laravel Fortify.
- Perfil de candidato con datos personales, localidad, carrera, biografía, enlaces profesionales, foto y CV.
- Postulaciones con estado, historial, reactivación de una postulación retirada y retiro mientras esté pendiente o en revisión.
- Panel administrativo y consultas de usuarios, ofertas y empresas; administración de categorías con eliminación lógica y restauración.
- Datos de referencia para tipos de usuario, ofertas, modalidades, contratación, categorías, subcategorías, localidades, carreras, empresas y ofertas de ejemplo.

## Roles y permisos

| Rol           | Capacidades disponibles                                                                           | Entrada principal |
| ------------- | ------------------------------------------------------------------------------------------------- | ----------------- |
| Administrador | Panel y consulta de usuarios, ofertas y empresas; crear, editar, eliminar y restaurar categorías. | `/admin`          |
| Empresa       | Panel y vista de perfil de empresa.                                                               | `/empresa`        |
| Estudiante    | Perfil, pasantías y postulaciones. No puede acceder a ofertas de trabajo.                         | `/usuario`        |
| Graduado      | Perfil, ofertas de trabajo y postulaciones. No puede acceder a pasantías.                         | `/usuario`        |
| Docente       | Perfil, ofertas de trabajo y postulaciones. No puede acceder a pasantías.                         | `/usuario`        |

Las rutas por rol se protegen con los middleware `admin`, `empresa` y `usuario`. Las rutas de postulación también exigen `perfil.completo`. El detalle de una oferta requiere iniciar sesión y no está disponible para cuentas de administrador o empresa.

## Flujos y reglas de negocio

### Registro y verificación

El registro de candidato valida que DNI, legajo y tipo de usuario coincidan con una persona activa del padrón institucional y que esa persona no tenga otra cuenta. Se crea un perfil inicial con los datos institucionales. La cuenta no inicia sesión automáticamente.

El registro de empresa crea una cuenta y una empresa asociada. En ambos registros se solicita correo, contraseña confirmada de al menos 8 caracteres y aceptación de términos. Las cuentas de candidato y empresa deben verificar su correo antes de iniciar sesión; el administrador está exento.

Google OAuth no omite el control institucional: si el correo aún no tiene cuenta, se conserva temporalmente para continuar el registro normal del candidato. La callback local debe coincidir con la URL configurada en Google.

### Perfil de candidato

El perfil se considera completo cuando tiene legajo, dirección, DNI, localidad y teléfono. Si falta alguno, las páginas protegidas redirigen a `/usuario/perfil`. El formulario además solicita nombre, fecha de nacimiento y localidad; permite biografía, LinkedIn y GitHub. La foto admite JPG/JPEG/PNG hasta 2 MB y el CV PDF hasta 5 MB.

### Ofertas y postulaciones

- Estudiantes solo pueden ver y solicitar pasantías; graduados y docentes solo pueden ver y solicitar trabajos.
- Solo se muestran ofertas activas. Para postularse, además, la fecha de cierre no debe haber vencido.
- No se admite más de una postulación vigente por persona y oferta. Una postulación retirada puede volver a activarse y pasa a estado `pendiente`.
- Los estados disponibles en la base son `pendiente`, `en_revision`, `seleccionado`, `rechazado` y `retirado`.
- Una postulación solo se puede retirar cuando está `pendiente` o `en_revision`.

### Autenticación en dos pasos

El candidato puede configurar 2FA desde su perfil, escanear el QR y confirmar un código TOTP de seis dígitos. En el inicio de sesión se solicita ese código o un código de recuperación; usar un código de recuperación lo invalida. Se pueden regenerar los códigos de recuperación.

## Rutas

Las rutas web están definidas en `routes/web.php`.

| Método      | Ruta                                          | Uso                                                               |
| ----------- | --------------------------------------------- | ----------------------------------------------------------------- |
| GET         | `/`                                           | Inicio y ofertas destacadas.                                      |
| GET         | `/ofertas`                                    | Catálogo paginado de ofertas activas.                             |
| GET         | `/oferta/{slug}/{id}`                         | Detalle de oferta para cuentas de candidato autenticadas.         |
| GET/POST    | `/login`                                      | Formulario e inicio de sesión.                                    |
| GET/POST    | `/register`                                   | Formulario y registro de candidato.                               |
| POST        | `/registro/candidato`                         | Registro de candidato.                                            |
| POST        | `/registro/empresa`                           | Registro de empresa.                                              |
| POST        | `/logout`                                     | Cierre de sesión.                                                 |
| GET         | `/auth/google`                                | Inicio de OAuth con Google.                                       |
| GET         | `/auth/google/callback`                       | Retorno de OAuth con Google.                                      |
| GET         | `/email/verificar/{id}/{hash}`                | Verificación firmada del correo.                                  |
| GET         | `/recuperar`                                  | Vista personalizada de recuperación, actualmente vacía.           |
| GET/POST    | `/forgot-password`                            | Vista y solicitud Fortify para enviar enlace de restablecimiento. |
| GET         | `/reset-password/{token}`                     | Formulario Fortify de restablecimiento.                           |
| POST        | `/reset-password`                             | Guardar la contraseña nueva.                                      |
| GET/POST    | `/usuario/2fa/login`                          | Confirmación 2FA durante el inicio de sesión.                     |
| GET         | `/admin`                                      | Inicio del panel administrativo.                                  |
| GET         | `/admin/usuarios`                             | Consulta de usuarios.                                             |
| GET         | `/admin/ofertas-laborales`                    | Consulta de ofertas.                                              |
| GET         | `/admin/empresas`                             | Consulta de empresas.                                             |
| GET         | `/admin/categorias`                           | Listado de categorías.                                            |
| GET         | `/admin/categorias/create`                    | Formulario para crear categoría.                                  |
| POST        | `/admin/categorias`                           | Crear categoría.                                                  |
| GET         | `/admin/categorias/{id}/edit`                 | Formulario para editar categoría.                                 |
| PUT/DELETE  | `/admin/categorias/{id}`                      | Actualizar o eliminar categoría.                                  |
| POST        | `/admin/categorias/{id}/restore`              | Restaurar categoría eliminada lógicamente.                        |
| GET         | `/empresa`                                    | Inicio del panel de empresa.                                      |
| GET         | `/empresa/perfil`                             | Vista de perfil de empresa.                                       |
| GET         | `/usuario`                                    | Inicio del área de candidato.                                     |
| GET/PUT     | `/usuario/perfil`                             | Consultar y actualizar perfil.                                    |
| GET         | `/usuario/trabajos`                           | Listado de trabajos para graduados y docentes.                    |
| GET         | `/usuario/pasantias`                          | Listado de pasantías para estudiantes.                            |
| GET         | `/usuario/postulaciones`                      | Historial del candidato.                                          |
| POST        | `/usuario/postularse/{id}`                    | Crear o reactivar postulación.                                    |
| POST        | `/usuario/postulaciones/{id}/retirar`         | Retirar postulación elegible.                                     |
| POST/DELETE | `/usuario/2fa`                                | Habilitar o deshabilitar 2FA.                                     |
| GET         | `/usuario/2fa/qr`                             | QR para configurar 2FA.                                           |
| POST        | `/usuario/2fa/confirmar`                      | Confirmar configuración 2FA.                                      |
| GET         | `/usuario/2fa/codigos-recuperacion`           | Ver códigos de recuperación.                                      |
| POST        | `/usuario/2fa/codigos-recuperacion/regenerar` | Regenerar códigos.                                                |
| POST        | `/user/passkeys`                              | Endpoint Fortify para registrar passkey.                          |
| GET         | `/user/passkeys/options`                      | Opciones para registrar passkey.                                  |
| DELETE      | `/user/passkeys/{passkey}`                    | Eliminar passkey.                                                 |
| GET         | `/passkeys/login/options`                     | Opciones para iniciar sesión con passkey.                         |
| POST        | `/passkeys/login`                             | Iniciar sesión con passkey.                                       |

## Tecnologías

- PHP 8.2+, Laravel 12, Laravel Fortify, Laravel Passkeys y Laravel Socialite.
- MySQL/MariaDB para desarrollo local recomendado; SQLite está disponible como configuración inicial de Laravel y para pruebas.
- Vite 6, Tailwind CSS 4 y JavaScript con módulos ES.
- PHPUnit 11 para pruebas.

## Requisitos

- PHP 8.2 o superior con las extensiones requeridas por Laravel y el controlador PDO de la base elegida.
- Composer.
- Node.js y npm.
- MySQL/MariaDB activo si se usa XAMPP.
- Git para clonar el repositorio.

## Instalación local con XAMPP

1. Clonar el proyecto y entrar al directorio:

    ```bash
    git clone <url-del-repositorio>
    cd bolsa-trabajo
    ```

2. Instalar dependencias:

    ```bash
    composer install
    npm install
    ```

3. Crear el archivo de entorno. En Git Bash:

    ```bash
    cp .env.example .env
    ```

    En PowerShell se puede usar `Copy-Item .env.example .env`.

4. Iniciar MySQL desde XAMPP y crear la base de datos `bolsa-trabajo`. Configurar `.env`:

    ```env
    APP_NAME="Bolsa de Trabajo"
    APP_URL=http://127.0.0.1:8000

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=bolsa-trabajo
    DB_USERNAME=root
    DB_PASSWORD=
    ```

    Si MySQL tiene contraseña, indicar su valor en `DB_PASSWORD`. También se puede usar SQLite configurando `DB_CONNECTION=sqlite` y la ruta de la base según la configuración local.

5. Generar la clave, crear las tablas y cargar datos iniciales:

    ```bash
    php artisan key:generate
    php artisan migrate --seed
    php artisan storage:link
    ```

6. En terminales separadas, iniciar Laravel y Vite:

    ```bash
    php artisan serve
    ```

    ```bash
    npm run dev
    ```

    Abrir la URL que indique `artisan serve` (por defecto `http://127.0.0.1:8000`). También existe `composer run dev`, que inicia servidor, queue listener, logs y Vite en paralelo.

## Configuración opcional

### Google OAuth

Crear credenciales OAuth de tipo aplicación web en Google y configurar las variables siguientes en `.env`. La URL de retorno debe estar registrada exactamente en la consola de Google:

```env
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback
```

### Correo de verificación

`.env.example` usa `MAIL_MAILER=log`: los mensajes de verificación se escriben en `storage/logs/laravel.log` en vez de enviarse por SMTP. Para entregar correos reales, configurar un proveedor de correo en `.env`.

### Archivos del perfil

Las fotos y los CV se guardan en el disco `public`, bajo `storage/app/public/perfiles/`. `php artisan storage:link` publica el enlace necesario para servirlos desde `public/storage`.

## Datos de desarrollo

`php artisan migrate --seed` ejecuta `DatabaseSeeder`, que carga los tipos de usuario y oferta, carreras, categorías, subcategorías, localidades, modalidades, tipos de contratación, empresas, personas institucionales y ofertas de ejemplo.

El seeder crea un administrador local:

| Correo                   | Contraseña |
| ------------------------ | ---------- |
| `admin@bolsatrabajo.com` | `12345678` |

Es una credencial únicamente para desarrollo local. Cambiarla antes de cualquier despliegue y no reutilizarla en entornos compartidos. Los demás usuarios semilla están sujetos a las reglas normales de verificación de correo y perfil.

Para reconstruir la base local desde cero se puede ejecutar `php artisan migrate:fresh --seed`. **Este comando elimina todas las tablas y los datos existentes.**

## Pruebas y compilación

Ejecutar la suite PHP:

```bash
php artisan test
```

Las pruebas de funcionalidad actuales comprueban acceso al panel administrativo y de usuario, y denegación por rol. Para compilar los assets:

```bash
npm run build
```

## Estructura del proyecto

```text
app/
  Http/Controllers/   Controladores web y de autenticación
  Http/Middleware/    Restricciones de rol y perfil completo
  Models/             Modelos Eloquent del dominio
  Notifications/      Notificaciones de la aplicación
  Providers/          Proveedores de servicios y Fortify
bootstrap/            Arranque y alias de middleware
config/               Configuración de Laravel y servicios externos
database/
  migrations/         Esquema de la base de datos
  seeders/            Datos iniciales y de desarrollo
resources/
  css/ js/ views/     Assets y vistas Blade
routes/web.php        Rutas HTTP
tests/                Pruebas PHPUnit
```

## Modelo de datos

El dominio principal se organiza alrededor de usuarios y tipos de usuario, personas del padrón institucional, perfiles, empresas, ofertas (`trabajos`) y postulaciones. Las ofertas se relacionan con tipo de oferta, categoría, subcategoría, modalidad y tipo de contratación. También existen tablas de carreras y localidades. Categorías y ofertas usan eliminación lógica. La migración de autenticación agrega campos de 2FA a usuarios; la tabla `passkeys` almacena credenciales WebAuthn.

## Alcance actual y pendientes

- El panel de empresa y su perfil son vistas; actualmente no hay operaciones para que una empresa cree, edite o administre ofertas desde la aplicación.
- Administración ofrece consultas de usuarios, ofertas y empresas. El CRUD funcional disponible en ese panel es el de categorías; no se ofrece CRUD de ofertas ni de subcategorías.
- `SubcategoriaController` y `TrabajoController` contienen acciones incompletas/no conectadas a las rutas actuales.
- Fortify registra las rutas y acciones backend para solicitar y guardar una contraseña nueva (`/forgot-password` y `/reset-password`). La vista personalizada `/recuperar`, enlazada desde el login, está vacía; falta terminar la interfaz completa de recuperación.
- Passkeys está habilitado en la configuración Fortify y sus rutas se registran automáticamente, pero el modelo `User` aún no integra el trait del paquete y no hay interfaz propia. El flujo no debe considerarse listo para uso hasta completar y probar esa integración.

Estas limitaciones describen el estado del código y no impiden navegar ofertas ni postularse como candidato cuando se cumplen las reglas anteriores.
