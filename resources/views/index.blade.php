@extends('layouts.main')

@section('content')

<h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Movies</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
        @foreach ($popularMovies as $movie)
            <div class="mt-8">
                  <!-- Link to the movie details page -->
                 <a href="{{ route('movieDetails.index', $movie['id']) }}">
                    <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}"
                         alt="{{ $movie['title'] }}" class="w-full h-auto mb-2 hover:opacity-75 transition ease-in-out duration-150">
                </a>
                <div class="mt-2">
                    <a href="{{ route('movieDetails.index', $movie['id']) }}" class="text-lg mt-2 hover:text-gray-300">{{ $movie['title'] }}</a>
                    <div class="flex items-center text-gray-400 text-sm mt-1">
                        <i class="fa-solid fa-star" style="color: #f97316;"></i>
                        <span class="ml-1">{{ intval($movie['vote_average'] * 10) .'%' }}</span>
                        <span class="mx-2"><i class="fa-solid fa-minus fa-rotate-90" style="color: #fff;"></i></span>
                        <span>{{ date('Y', strtotime($movie['release_date'])) }}</span>
                    </div>
                    <div class="text-gray-400 text-sm">{{ $movie['genres'] }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection


