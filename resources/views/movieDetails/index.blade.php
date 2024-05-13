@extends('layouts.main')


@section('content')
<div class="movie-info border-b border-gray-800">
    <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
        <div class="flex-none">
            <img src="https://image.tmdb.org/t/p/w500{{ $movieDetails['poster_path'] }}"  alt="{{ $movieDetails['title'] }}" class="w-64 lg:w-96">
        </div>


        <div class="md:ml-24">
            <h2 class="text-4xl mt-4 md:mt-0 font-semibold">{{ $movieDetails['title'] }}</h2>
            <div class="flex flex-wrap items-center text-gray-400 text-sm">
                <i class="fa-solid fa-star" style="color: #f97316;"></i>
                <span class="ml-1">{{ $movieDetails['vote_average'] }}</span>
                <span class="mx-2">|</span>
                <span>{{ $movieDetails['release_date'] }}</span>
                <span class="mx-2">|</span>
                <span>{{ $movieDetails['runtime'] }} mins</span>
                <span class="mx-2">|</span>
                <span>{{ $movieDetails['genres'] }}</span>
            </div>

            <p class="text-gray-300 mt-8">
                Directed by
                <b>{{ $movieDetails['directors'] }}</b>
            </p>

            <p class="text-gray-300 mt-8">
                {{ $movieDetails['overview'] }}
            </p>


            <div class="mt-12">
                <button class="flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">
                    <svg class="w-6 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                    <span class="ml-2">Play Trailer</span>
                </button>
            </div>

            <div class="mt-12">
                <h4 class="text-white font-semibold">Crew</h4>
                <div class="flex mt-4">
                    <ul>
                     @foreach ($crew as $member)
                        <li>{{ $member['name'] }} -
                        <span class="text-sm text-gray-400">{{ $member['job'] }}</span></li>
                     @endforeach
                    </ul>
                </div>
            </div>

        </div>

    </div>
</div>

<div class="movie-cast border-b border-gray-800">
    <div class="container mx-auto px-4 py-16">

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            <button class="flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">
                <i class="fa-regular fa-eye"></i>
                <span class="ml-2">Watch</span>
            </button>


            <button class="flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">
                <i class="fa-regular fa-heart"></i>
                <span class="ml-2">Like</span>
            </button>

            <button class="flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">
                <i class="fa-regular fa-clock"></i>
                <span class="ml-2">Watchlist</span>
            </button>

            <button class="flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">
                <i class="fa-regular fa-message"></i>
                <span class="ml-2">Review</span>
            </button>

            {{-- TODO INSIDE THE MODAL REVIEW
                Will be a form to put the text and a option to rate it --}}
            <button class="flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">
                <i class="fa-regular fa-star"></i>
                <span class="ml-2">Rate</span>
            </button>

        </div>
    </div>
</div>

<div class="movie-cast border-b border-gray-800">
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-semibold">Cast</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">

        </div>
    </div>
</div>

    <div class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-semibold">Images</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">

        </div>
    </div>

@endsection


