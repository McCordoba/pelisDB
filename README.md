# PelisDB

<p align="center"><img src="public/img/PelisDB_logo_white.png" width="400" alt="PelisBD Logo"></a></p>

# Definición del proyecto

El proyecto consiste en el desarrollo de una plataforma web especializada en cine, con funcionalidades similares a las ofrecidas por IMDb. Los usuarios tendrán la capacidad de agregar películas a sus listas de favoritos o pendientes de ver, así cómo escribir reseñas sobre las mismas.

Para garantizar la disponibilidad de una amplia gama de datos actualizados, se empleará la API de themoviedb. Esta API será utilizada para realizar solicitudes y obtener información de una extensa base de datos relacionada con el cine.

La información obtenida a través de la API se almacenará en una base de datos SQL. Esto permitirá que los usuarios accedan y consulten sus datos en cualquier momento, asegurando así la persistencia de la información.

Además, se implementará una sección de acceso exclusivo para los administradores de la plataforma. En esta sección, los administradores podrán visualizar y gestionar los registros almacenados en la tabla de usuarios, pudiendo modificar, añadir o eliminar datos según sea necesario, mediante una interfaz gráfica.

# Tecnologías utilizadas

- Front-end

  - HTML
  - CSS
  - Tailwind (css)
  - JavaScript

- Back-end

  - Laravel Blade y Liveware
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

# Diagrama E/R de la base de datos

# Diseño físico de la base de datos

# Funcionalidades

- Cada película tendrá su poster de lanzamiento, nombre, director(es), reparto, etc.
- El usuario deberá registrarse para hacer una reseña sobre una película, añadirla a favoritos, etc.
- Los usuarios sin cuenta pueden buscar información sobre películas.
- Las reseñas siempre deberán contener texto, y opcionalmente, una calificación.

# Diseño de la página web

# Bibliografía

- [Documentación de Laravel](https://laravel.com/docs/11.x).
- [Documentación de la API TMDB](https://developer.themoviedb.org/docs/getting-started).
- [Documentación de Tailwind CSS](https://tailwindcss.com/docs/installation).
- [Documentación de Livewire](https://livewire.laravel.com/docs/quickstart).
- [Documentación de Font Awesome](https://docs.fontawesome.com/).

## Licencias de uso

- [The Movie Database](https://www.themoviedb.org/api-terms-of-use).
- [Font Awesome](https://fontawesome.com/license/free).
