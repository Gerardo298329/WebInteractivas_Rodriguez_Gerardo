# Página Completa Comercial - Pizzería-Ya

## Introducción

Pizzería Ya es una página comercial de una sola página (landing page) para una pizzería del Centro Histórico de San Luis Potosí, México. Presenta el menú, las promociones, la historia del negocio, las reseñas y la ubicación de sus sucursales, y permite al cliente armar su pizza paso a paso, agregarla a un carrito y realizar su pedido.

Está desarrollada con Laravel (Blade), Bootstrap 5 personalizado con Sass, jQuery y Leaflet.

- Alumno: Gerardo Gabriel Rodriguez Cervantes
- Materia: Aplicaciones Web Interactivas
- Semestre: 2026-2027/I
- Profesor: Gonzalez Medina Odilon
- Fecha: 08/11/2026

## Requisitos

- PHP 8.2 o superior
- Composer
- Node.js 18 o superior y npm
- Git

## Cómo descargar el proyecto

El proyecto está dentro del repositorio, en la ruta `Parcial2/pizzeria-ya_Comercial`. Para descargar solo esa carpeta:

```bash
git clone --no-checkout https://github.com/Gerardo298329/WebInteractivas_Rodriguez_Gerardo.git
cd WebInteractivas_Rodriguez_Gerardo
git sparse-checkout init --cone
git sparse-checkout set Parcial2/pizzeria-ya_Comercial
git checkout main
cd Parcial2/pizzeria-ya_Comercial
```

También puedes descargar todo el repositorio con el botón verde **Code → Download ZIP** y abrir la carpeta `Parcial2/pizzeria-ya_Comercial`.

## Instalación (solo la primera vez)

Dentro de la carpeta `pizzeria-ya_Comercial`:

```bash
composer install
npm install
copy .env.example .env
php artisan key:generate
```

En Mac o Linux, usa `cp .env.example .env` en lugar de `copy`.

Abre el archivo `.env` y verifica que contenga:

```
SESSION_DRIVER=file
```

## Cómo ejecutarlo

1. En una terminal:

```bash
npm run dev
```

2. En otra terminal, dentro de la misma carpeta:

```bash
php artisan serve
```

3. Abrir en el navegador: http://localhost:8000

Las dos terminales deben quedar abiertas mientras se usa la página.

## Secciones y funcionalidades

- Portada, menú por categorías, promociones, quiénes somos, reseñas y ubicación con mapa.
- Armado de pizza en 6 pasos, con ingredientes en tres niveles (Poco, Normal, Extra).
- Carrito con editar, eliminar, cancelar y confirmación de pedido.
- Diseño responsivo con Bootstrap para celular, tableta y escritorio.

## Pendientes

- Base de datos para guardar pedidos e historial.
- Panel de administración.
- Reemplazar los datos de ejemplo (direcciones, teléfono y reseñas) por los reales.
