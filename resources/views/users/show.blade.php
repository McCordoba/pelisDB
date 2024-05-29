@extends('layouts.main')

@section('content')

    <div class="user-info border-b border-gray-500">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">

            <div class="flex-none flex flex-col items-center">
                @if ($user->image)
                    <img src="{{ asset('storage/' . $user->image) }}" alt="avatar" class="rounded-full w-64 h-64">
                @else
                    <img src="https://placehold.co/200x200" alt="avatar" class="rounded-full w-64 h-64">
                @endif

                <div class="mt-4">
                    <button
                    class="flex items-center rounded font-semibold w-48 h-12 justify-center transition ease-in-out duration-150">
                <span class="ml-2">
                    <a class="movieLog"
                       href="{{ route('users.edit', auth()->user()->id) }}">Edit user data</a>
                </span>
                </div>
            </div>

            <div class="md:ml-24">
                <h2 class="text-4xl mt-4 md:mt-0 font-semibold" style="color: #00e054;">User Details</h2>
                <div class="py-2">
                    <label class="text-gray-700 font-bold">Name:</label>
                    <span class="text-gray-300">{{ $user->name }}</span>
                </div>
                <div class="py-2">
                    <label class="text-gray-700 font-bold">Email:</label>
                    <span class="text-gray-300">{{ $user->email }}</span>
                </div>
                <div class="py-2">
                    <label class="text-gray-700 font-bold">Films:</label>
                    <span class="text-gray-300">number of movies in the watched table and link</span>
                </div>
                <div class="py-2">
                    <label class="text-gray-700 font-bold">Watchlist:</label>
                    <span class="text-gray-300">number of movies in the Watchlist and link</span>
                </div>
                <div class="py-2">
                    <label class="text-gray-700 font-bold">Likes:</label>
                    <span class="text-gray-300">number of liked movies and link</span>
                </div>
                <div class="py-2">
                    <label class="text-gray-700 font-bold">Reviews:</label>
                    <span class="text-gray-300">number of reviews and link</span>
                </div>
            </div>
        </div>
    </div>

    <div class="user-info border-b border-gray-500">
    <div class="container mx-auto px-4 py-16">

        <h3 class="text-2xl font-semibold">Liked movies</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">

            @foreach($likedMovies as $movie)
                <div class="mt-8">
                    <a href="{{ route('movieDetails.index', $movie->movie_id) }}">
                        <img src="https://image.tmdb.org/t/p/w300{{ $movie->poster_path }}"
                             class="hover:opacity-75 transition ease-in-out duration-150" alt="{{$movie->title}}">
                    </a>
                    <div class="mt-2">
                        <a href="{{ route('movieDetails.index', $movie->movie_id) }}" class="text-lg mt-2 hover:text-gray:300">{{$movie->title}} ({{ date('Y', strtotime($movie->release_date)) }})</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </div>

    <div class="user-info border-b border-gray-500">
    <div class="container mx-auto px-4 py-16">
        <h3 class="text-2xl font-semibold">Watched</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">

            @foreach($watchedMovies as $movie)
                <div class="mt-8">
                    <a href="{{ route('movieDetails.index', $movie->movie_id) }}">
                        <img src="https://image.tmdb.org/t/p/w300{{ $movie->poster_path }}"
                             class="hover:opacity-75 transition ease-in-out duration-150" alt="{{$movie->title}}">
                    </a>
                    <div class="mt-2">
                        <a href="{{ route('movieDetails.index', $movie->movie_id) }}" class="text-lg mt-2 hover:text-gray:300">{{$movie->title}} ({{ date('Y', strtotime($movie->release_date)) }})</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </div>

    <div class="user-info border-b border-gray-500">
        <div class="container mx-auto px-4 py-16">
            <h3 class="text-2xl font-semibold">Watchlist</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">

                @foreach($listedMovies as $movie)
                    <div class="mt-8">
                        <a href="{{ route('movieDetails.index', $movie->movie_id) }}">
                            <img src="https://image.tmdb.org/t/p/w300{{ $movie->poster_path }}"
                                 class="hover:opacity-75 transition ease-in-out duration-150" alt="{{$movie->title}}">
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('movieDetails.index', $movie->movie_id) }}" class="text-lg mt-2 hover:text-gray:300">{{$movie->title}} ({{ date('Y', strtotime($movie->release_date)) }})</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        </div>

        <div class="container mx-auto px-4 py-16">
            <h3 class="text-2xl font-semibold">Reviews</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">

                @foreach($reviews as $movie)
                    <div class="mt-8">
                        <a href="{{ route('movieDetails.index', $movie->movie_id) }}" class="text-m mr-4 hover:text-gray:300">{{$movie->title}} ({{ date('Y', strtotime($movie->release_date)) }})</a>
                        <a href="{{ route('movieDetails.index', $movie->movie_id) }}">
                            <img src="https://image.tmdb.org/t/p/w92{{ $movie->poster_path }}"
                                 class="hover:opacity-75 transition ease-in-out duration-150 w-8" alt="{{$movie->title}}">
                        </a>

                        <div class="mt-2">
                            <p>Score: {{$movie->score}}</p>
                            <p>{{$movie->review}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        
@endsection
