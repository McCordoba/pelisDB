# PelisDB

<p align="center"><a ><img src="public/img/PelisDB_logo_white.png" width="400" alt="PelisBD Logo"></a></p>

# Definición del proyecto

El proyecto consiste en el desarrollo de una plataforma web especializada en cine, con funcionalidades similares a las ofrecidas por IMDb, letterboxd, etc. Como por ejemplo añadir películas a listas de favoritos o pendientes de ver, así cómo escribir reseñas sobre las mismas.

Para garantizar la disponibilidad de una amplia gama de datos actualizados relacionada con el cine, se empleará la API de themoviedb, parte de la información obtenida a través de la API se almacenará en una base de datos SQL, esto permitirá que los usuarios accedan y consulten sus datos en cualquier momento, pudiendo tener siempre disponible una lista de sus pelis favoritas, reviews, etc.

# Tecnologías utilizadas

- Front-end

  - HTML
  - CSS
  - Tailwind (css)
  - JavaScript

- Back-end

  - Laravel Blade y Livewire
  - MySQL
  - API themoviedb

- Librerías

  - Font Awesome
  - Hero icons

- Para realizar el despliegue

  - OVHcloud (hosting)

- Control de versiones y otras utilidades
  - Docker
  - GitHub
  - Inkscape

# Tablas de la Base de datos

Habrá 5 tablas en la base de datos, que son:

    - Users: contiene todos los datos de los usuarios que están registrados en la página.

    - Liked_movies: contiene las películas favoritas de los usuarios que están registrados en la página.

    - Reviews: contiene las reseñas a películas de los usuarios que están registrados en la página.

    - Watched_movies: contiene las películas vistas por los usuarios que están registrados en la página.

    - Watchlists: contiene las listas de películas que los usuarios que están registrados en la página desean ver.

# Diagrama E/R de la base de datos

<p align="center"><a><img src="public/img/Esquema entidad-relación.drawio.png" alt="diagrama_ER"></a></p>

# Diseño físico de la base de datos

<p align="center"><a><img src="public/img/Diseño físico.png" alt="Diseño físico"></a></p>

# Funcionalidades

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
