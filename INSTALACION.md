# Instalación y Configuración - Aplicación de Cafetería

## Requisitos Previos

Antes de ejecutar esta aplicación Laravel, necesitas tener instalado:

### 1. PHP (versión 8.1 o superior)

**Opción A: Instalar PHP con XAMPP (Recomendado para Windows)**
1. Descarga XAMPP desde: https://www.apachefriends.org/download.html
2. Instala XAMPP siguiendo el asistente
3. Inicia el Panel de Control de XAMPP
4. Asegúrate de que Apache y MySQL estén ejecutándose
5. Agrega PHP al PATH del sistema:
   - Ve a Variables de entorno del sistema
   - Agrega `C:\xampp\php` al PATH

**Opción B: Instalar PHP directamente**
1. Descarga PHP desde: https://windows.php.net/download/
2. Extrae los archivos en `C:\php`
3. Agrega `C:\php` al PATH del sistema
4. Copia `php.ini-development` a `php.ini`
5. Habilita las extensiones necesarias en `php.ini`:
   ```
   extension=pdo_mysql
   extension=mbstring
   extension=openssl
   extension=curl
   ```

### 2. Composer
1. Descarga Composer desde: https://getcomposer.org/download/
2. Ejecuta el instalador para Windows
3. Reinicia la terminal después de la instalación

### 3. Node.js (para compilar assets)
1. Descarga Node.js desde: https://nodejs.org/
2. Instala siguiendo el asistente

## Pasos de Instalación

### 1. Configurar el entorno
```bash
# Navegar al directorio del proyecto
cd C:\Users\Alexis\OneDrive\Desktop\laravel\cafeteria-app

# Instalar dependencias de PHP
composer install

# Instalar dependencias de Node.js
npm install
```

### 2. Configurar la base de datos
```bash
# Copiar el archivo de configuración (ya está hecho)
cp .env.example .env

# Generar la clave de aplicación
php artisan key:generate
```

### 3. Configurar la base de datos en el archivo .env
Edita el archivo `.env` y configura tu base de datos:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cafeteria_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Crear la base de datos
Si usas XAMPP:
1. Ve a http://localhost/phpmyadmin
2. Crea una nueva base de datos llamada `cafeteria_db`

### 5. Ejecutar migraciones y seeders
```bash
# Ejecutar las migraciones para crear las tablas
php artisan migrate

# Poblar la base de datos con datos de ejemplo
php artisan db:seed
```

### 6. Compilar assets
```bash
# Compilar CSS y JavaScript
npm run dev

# O para producción
npm run build
```

### 7. Iniciar el servidor
```bash
# Iniciar el servidor de desarrollo
php artisan serve
```

La aplicación estará disponible en: http://localhost:8000

## Estructura del Proyecto

### Modelos Principales
- **Category**: Categorías de productos (Cafés Calientes, Cafés Fríos, Postres, etc.)
- **Product**: Productos de la cafetería con precios, stock e imágenes
- **Order**: Pedidos de los clientes
- **OrderItem**: Elementos individuales de cada pedido

### Controladores
- **HomeController**: Página principal y navegación
- **CartController**: Gestión del carrito de compras
- **OrderController**: Procesamiento de pedidos

### Funcionalidades Implementadas
- ✅ Catálogo de productos por categorías
- ✅ Carrito de compras con JavaScript
- ✅ Sistema de checkout
- ✅ Gestión de pedidos
- ✅ Diseño responsivo con Bootstrap
- ✅ Base de datos poblada con productos de ejemplo

## Datos de Ejemplo

La aplicación incluye:
- **6 categorías** de productos
- **30+ productos** de cafetería
- Precios en pesos colombianos
- Stock y disponibilidad configurados

## Solución de Problemas

### Error: 'php' no se reconoce como comando
- Asegúrate de que PHP esté instalado y agregado al PATH
- Reinicia la terminal después de instalar PHP
- Verifica la instalación con: `php --version`

### Error: 'composer' no se reconoce como comando
- Instala Composer desde el sitio oficial
- Reinicia la terminal después de la instalación
- Verifica con: `composer --version`

### Error de conexión a la base de datos
- Verifica que MySQL esté ejecutándose
- Confirma las credenciales en el archivo `.env`
- Asegúrate de que la base de datos `cafeteria_db` exista

### Problemas con assets (CSS/JS)
- Ejecuta `npm install` para instalar dependencias
- Ejecuta `npm run dev` para compilar assets
- Verifica que Node.js esté instalado

## Próximos Pasos

Una vez que tengas PHP instalado y funcionando:
1. Ejecuta las migraciones: `php artisan migrate`
2. Pobla la base de datos: `php artisan db:seed`
3. Inicia el servidor: `php artisan serve`
4. Visita http://localhost:8000 para ver la aplicación

¡Tu aplicación de cafetería estará lista para usar!