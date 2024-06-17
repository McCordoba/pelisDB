# PelisDB

<p align="center"><a target="_blank"><img src="public/img/PelisDB_logo_white.png" width="400" alt="PelisBD Logo"></a></p>

# Definición del proyecto

El proyecto consiste en el desarrollo de una plataforma web especializada en cine, con funcionalidades similares a las ofrecidas por IMDb, letterboxd, etc. Como por ejemplo añadir películas a listas de favoritos o pendientes de ver, así cómo escribir reseñas sobre las mismas.

Para garantizar la disponibilidad de una amplia gama de datos actualizados relacionada con el cine, se empleará la API de themoviedb, parte de la información obtenida a través de la API se almacenará en una base de datos SQL, esto permitirá que los usuarios accedan y consulten sus datos en cualquier momento, pudiendo tener siempre disponible una lista de sus pelis favoritas, reviews, etc.

## Página desplegada

- https://mccorgut.es/

## Instalación

### Requisitos previos

- Antes de la instalación de la app necesitarás tener en tu equipo:

  - Node.js
  - npm
  - Composer (no es necesario tenerlo instalado de forma global en el equipo aunque es recomendable)
  - PHP
  - MySQL (servidor y cliente)
  - phpMyAdmin (opcional)

  > **_Nota:_** Para tener instalados, PHP, MySQL y phpMyAdmin se puede usar XAMPP

### Pasos para la instalación

1. Clona el repositorio (`Git clone https://github.com/McCordoba/pelisDB.git`) y entra en él (`cd pelisDB`).
1. Ejecuta `composer install`
1. Instala los paquetes npm `npm install` y ejecutalos `npm run dev`
1. Lanza el servidor de Laravel `php artisan serve`
1. Visita `localhost:8000` en tu navegador.
1. Crea una base de datos llamada `pelisdb`
1. Renombra o copia el archivo `.env.example` a `.env`
1. Configura los datos para la conexión a la BD en el archivo `.env`
1. Establece tu `TMDB_TOKEN` en el archivo `.env`, puedes obtener una clave para la API [aquí](https://www.themoviedb.org/documentation/api).
1. Genera una clave de aplicación con el comando `php artisan key:generate`
1. Ejecuta las migraciones a la BD (para las tablas sin datos) `php artisan migrate:fresh`
1. Si quieres la tablas con datos ejecuta (para las migraciones y los seeders) `php artisan migrate:refresh --seed`
1. Por último, para que la funcionalidad de que los usuarios puedan subir imagenes de perfil, se debe ejecutar el comando `php artisan storage:link`

# Tecnologías utilizadas

- Front-end

  - HTML
  - CSS
  - Tailwind (css)
  - JavaScript

- Back-end

  - Laravel con Blade
  - Livewire (para la barra de búsqueda)
  - MySQL
  - API The Movie Database (TMDB)

- Para realizar el despliegue

  - [Ionos VPS](https://www.ionos.es/servidores/vps)
  - [IONOS Dominio](https://www.ionos.es/dominios/dominios)

- Control de versiones y otras utilidades
  - GitHub
  - Postman
  - Inkscape
  - Blender
  - GIMP
  - Infinite Scroll (Librería de JS)
  - Font Awesome (Librería de iconos)
  - Hero icons (Librería de iconos)

# Tablas de la Base de datos

Habrá 5 tablas en la base de datos, que son:

    - Users: contiene todos los datos de los usuarios que están registrados en la página.

    - Liked_movies: contiene las películas favoritas de los usuarios que están registrados en la página.

    - Reviews: contiene las reseñas a películas de los usuarios que están registrados en la página.

    - Watched_movies: contiene las películas vistas por los usuarios que están registrados en la página.

    - Watchlists: contiene las listas de películas que los usuarios que están registrados en la página desean ver.

# Diagrama E/R de la base de datos

<p align="center"><a target="_blank"><img src="public/img/Esquema entidad-relación.drawio.png" alt="diagrama_ER"></a></p>

# Diseño físico de la base de datos

<p align="center"><a target="_blank"><img src="public/img/Diseño físico.png" alt="Diseño físico"></a></p>

# Algunas funcionalidades

- Cada película tendrá su poster de lanzamiento, nombre, director(es), reparto, etc.
- Los usuarios sin cuenta pueden buscar información sobre películas, actores, directores, etc.
- Los usuarios deberán registrarse para poder hacer una reseña sobre una película, añadirla a favoritos, etc.
- Las reseñas siempre deberán contener texto, y opcionalmente, una calificación.
- Los usuarios registrados dispondrán de una sección en la que podrán consultar sus datos y modificarlos si lo desean.

# Bibliografía

- [Documentación de Laravel](https://laravel.com/docs/11.x).
- [Documentación de la API TMDB](https://developer.themoviedb.org/docs/getting-started).
- [Documentación de Tailwind CSS](https://tailwindcss.com/docs/installation).
- [Documentación de Livewire](https://livewire.laravel.com/docs/quickstart).
- [Documentación de Font Awesome](https://docs.fontawesome.com/).

## Licencias de uso

- [The Movie Database](https://www.themoviedb.org/api-terms-of-use).
- [Font Awesome](https://fontawesome.com/license/free).
