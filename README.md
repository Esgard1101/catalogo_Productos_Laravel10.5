
# Catálogo de Productos – Laravel 10.5

CRUD de productos, marcas, categorías y unidades desarrollado con **Laravel 10.5**.

El proyecto implementa:
- Migraciones
- Form Requests
- Exportación a PDF con **DomPDF**
- Exportación a Excel con **Maatwebsite / Excel**

## Requisitos
- PHP 8.1 o superior
- Composer
- MySQL
- XAMPP

## Instalación
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve


