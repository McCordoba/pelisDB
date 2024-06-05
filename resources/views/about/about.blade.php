@extends('layouts.main')

@section('content')
    <div class="about-info border-b border-gray-500">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <div class="flex-none">
                <img src="" class="w-64 lg:w-96 rounded-sm">
            </div>

            <div class="md:ml-24">
                <h2 class="text-4xl mt-4 md:mt-0 font-semibold"> Definición del proyecto</h2>
                <p class="text-gray-400 overflow-hidden" style="max-height: 4.5rem; line-height: 1.5rem;">El proyecto
                    consiste en el desarrollo de una plataforma web especializada en cine, con funcionalidades similares
                    a las ofrecidas por IMDb, letterboxd, etc. Como por ejemplo añadir películas a listas de favoritos o
                    pendientes de ver, así cómo escribir reseñas sobre las mismas.

                    Para garantizar la disponibilidad de una amplia gama de datos actualizados relacionada con el cine,
                    se empleará la API de themoviedb, parte de la información obtenida a través de la API se almacenará
                    en una base de datos SQL, esto permitirá que los usuarios accedan y consulten sus datos en cualquier
                    momento, pudiendo tener siempre disponible una lista de sus pelis favoritas, reviews, etc.</p>
                <a class="mt-2 text-toggle">Read more <i class="fa-solid fa-arrow-right" ;"></i></a>


                <h3 class="text-white py-2 font-semibold">Tecnologías utilizadas</h3>
                <ul class="flex items-center text-gray-400 mt-4">
                    <li>

                    </li>
                </ul>
            </div>
        </div>
    </div>

@endsection
