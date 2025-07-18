Plataforma Solidaria

Plataforma web donde instituciones y fundaciones pueden crear campañas y recibir donaciones. El sistema permite registrar usuarios con diferentes roles (donante o fundación), publicar campañas solidarias y mostrar el progreso de cada iniciativa.

-- Desarrollado con Laravel y MySQL.

 (Funcionalidades)
Registro e inicio de sesión de usuarios

Roles: fundación y donante

Creación de campañas por parte de fundaciones

Donaciones por parte de usuarios donantes

Seguimiento del monto recaudado por campaña

Categorías de campañas (salud, educación, etc.)

Relación entre entidades usando claves foráneas

Factories y Seeders para poblar la base de datos

(Requisitos)
PHP >= 8.1

Composer

MySQL

Laravel 10+

Node.js (opcional para compilar assets)

⚙️ Instalación
Clonar el repositorio:


git clone https://github.com/PanchoGmZ/SIstemaWebDonaciones.git
cd ProyectoFinal
Instalar dependencias:

(terminal)
composer install
Copiar y configurar el archivo de entorno:

(Terminal)
cp .env.example .env
php artisan key:generate
Configurar base de datos en .env:

.env
DB_DATABASE=tw2
DB_USERNAME=root
DB_PASSWORD=

Ejecutar migraciones y seeders:

(Terminal)
php artisan migrate:fresh --seed
(Opcional) Ejecutar servidor:

(Termianl)
php artisan serve

(Estructura de Tablas Principales)
users: almacena usuarios y roles (donor, foundation)

foundation_profiles: perfil extendido para fundaciones

campaigns: campañas creadas por fundaciones

donations: donaciones hechas por los usuarios

categories: clasificaciones opcionales de campañas

Las relaciones están definidas con Eloquent y claves foráneas.

--Datos de prueba

Al ejecutar los seeders se crean:

5 fundaciones con campañas asociadas

10 usuarios donantes con donaciones simuladas

Puedes personalizar los factories en /database/factories.

--Estructura de carpetas clave

app/Models: Modelos Eloquent

database/migrations: Migraciones de tablas

database/factories: Factories para pruebas

database/seeders: Carga inicial de datos

 (Autor)
Proyecto elaborado como parte de práctica académica con Laravel.

Colaboradores:

Francisco Gomez Pocoaca
Vladimir Lizarazu Miranda

(Universidad Privada Domingo Savio)