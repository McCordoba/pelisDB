@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-8">

        <h3 class="text-2xl font-semibold">Movies Liked by {{ $user->name }}</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @if ($likedMovies->isEmpty())
                <p class="text-gray-400">No liked movies yet.</p>
            @else
                @foreach($likedMovies as $movie)
                    <div class="mt-8">
                        <a href="{{ route('movieDetails.index', $movie->movie_id) }}">
                            <img src="https://image.tmdb.org/t/p/w300{{ $movie->poster_path }}"
                                 class="hover:opacity-75 transition ease-in-out duration-150" alt="{{$movie->title}}">
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('movieDetails.index', $movie->movie_id) }}"
                               class="text-lg mt-2 hover:text-gray:300">{{$movie->title}}
                                ({{ date('Y', strtotime($movie->release_date)) }})</a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
