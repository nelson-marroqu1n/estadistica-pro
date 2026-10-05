# Estadística Pro

API desarrollada con Laravel para autenticación y administración de conjuntos de datos y sus filas.

## Requisitos

- PHP 8.2 o superior y Composer
- Node.js y npm
- Extensión PDO SQLite habilitada en PHP

## Instalación local

1. Clona el repositorio y entra en la carpeta:

   ```bash
   git clone https://github.com/USUARIO/REPOSITORIO.git
   cd REPOSITORIO
   ```

2. Instala las dependencias de PHP y JavaScript:

   ```bash
   composer install
   npm install
   ```

3. Crea tu archivo de configuración local y la base SQLite:

   ```bash
   cp .env.example .env
   ```

   En Windows PowerShell, usa `Copy-Item .env.example .env` en lugar de `cp` si tu versión de PowerShell no reconoce ese alias. Crea el archivo de base de datos vacío si todavía no existe:

   ```bash
   # macOS o Linux
   touch database/database.sqlite
   ```

   ```powershell
   # Windows PowerShell
   New-Item database/database.sqlite -ItemType File
   ```

   Confirma que `DB_CONNECTION=sqlite` esté configurado en `.env`.

4. Genera la clave de la aplicación y ejecuta las migraciones:

   ```bash
   php artisan key:generate
   php artisan migrate
   ```

5. Compila los recursos del frontend:

   ```bash
   npm run build
   ```

6. Inicia el servidor de desarrollo:

   ```bash
   php artisan serve
   ```

   La API queda disponible en `http://127.0.0.1:8000`. Las rutas API de Laravel usan el prefijo `/api`.

## Rutas disponibles

| Método | Ruta | Acción |
| --- | --- | --- |
| `POST` | `/api/login` | Iniciar sesión |
| `POST` | `/api/conjunto` | Consultar conjunto |
| `POST` | `/api/conjunto/crear` | Crear conjunto |
| `PUT` | `/api/conjunto/editar` | Editar conjunto |
| `DELETE` | `/api/conjunto` | Borrar conjunto |
| `POST` | `/api/conjunto/filas-all` | Consultar filas |
| `POST` | `/api/conjunto/filas-id` | Consultar filas por conjunto |
| `POST` | `/api/conjunto/fila` | Crear fila |
| `PUT` | `/api/conjunto/fila` | Editar fila |
| `DELETE` | `/api/conjunto/fila` | Borrar fila |

Los campos requeridos para cada ruta están definidos en las clases de validación de `app/Http/Requests`.

## Configuración y seguridad

- `.env` contiene la configuración local y no debe subirse al repositorio.
- Usa `.env.example` como plantilla y evita incluir contraseñas, claves privadas o datos personales.
- La base local `database/database.sqlite` se crea en cada instalación y no se comparte en Git.
- No subas `vendor/` ni `node_modules/`; las dependencias se instalan con Composer y npm usando sus archivos de bloqueo.

## Tecnologías

- Laravel 12
- PHP 8.2 o superior
- Vite, Tailwind CSS y npm
