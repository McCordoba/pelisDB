@extends('layouts.main')

@section('content')
    <div class="actor-info border-b border-gray-500">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <div class="flex-none">
                @if ($actorDetails['profile_path'])
                    <img src="https://image.tmdb.org/t/p/w500{{ $actorDetails['profile_path'] }}" alt="{{ $actorDetails['name'] }}" class="w-64 lg:w-96">
                @else
                    <img src="https://placehold.co/300x450?text=We don't have a portrait of\n{{ $actorDetails['name'] }}" alt="{{ $actorDetails['name'] }}" class="w-64 lg:w-96">
                @endif
            </div>

            <div class="md:ml-24">
                <h2 class="text-4xl mt-4 md:mt-0 font-semibold">{{ $actorDetails['name'] }}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm">
                    data
                </div>

                <h3 class="text-white py-2 font-semibold">Biography</h3>
                @if ($actorDetails['biography'])
                {{-- TODO Add a read more functionality if the text is to long --}}
                    <p class="text-gray-300">{{ $actorDetails['biography'] }}</p>
                    <a href="">Read More <i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i></a>
                @else
                    <p class="text-gray-300">We don't have a biography for {{ $actorDetails['name'] }}.</p>
                @endif
            </div>
        </div>
    </div>

    @if ($actorMovieCredits['cast'] > 0)
        <div class="movie-cast border-b border-gray-500">
            <div class="container mx-auto px-4 py-16">
                <h3 class="text-2xl font-semibold">FILMS STARRING</h3>
                <h4 class="text-2xl font-semibold">{{ $actorDetails['name'] }}</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                    @foreach ($movies as $movie)
                        <div class="mt-8">
                            <a href="{{ route('movieDetails.index', $movie['id']) }}">
                                @if ($movie['poster_path'])
                                    <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="hover:opacity-75 transition ease-in-out duration-150">
                                @else
                                    <img src="https://placehold.co/300x450?text={{ $movie['title'] }}" class="hover:opacity-75 transition ease-in-out duration-150">
                                @endif
                            </a>
                            <div class="mt-2">
                                <a href="{{ route('movieDetails.index', $movie['id']) }}" class="text-lg mt-2 hover:text-gray:300">{{ $movie['title'] }} ({{ date('Y', strtotime($movie['release_date'])) }})</a>
                                <div class="text-sm text-gray-400">
                                    <span>As {{ $movie['character'] }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    @if ($directedMovies->count() > 0)
        <div class="container mx-auto px-4 py-16">
            <h3 class="text-2xl font-semibold">FILMS DIRECTED BY</h3>
            <h4 class="text-2xl font-semibold">{{ $actorDetails['name'] }}</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($directedMovies as $directed)
                    <div class="mt-8">
                        <a href="{{ route('movieDetails.index', $directed['id']) }}">
                            @if ($directed['poster_path'])
                                <img src="https://image.tmdb.org/t/p/w500{{ $directed['poster_path'] }}" alt="{{ $directed['title'] }}" class="hover:opacity-75 transition ease-in-out duration-150">
                            @else
                                <img src="https://placehold.co/300x450?text={{ $directed['title'] }}" class="hover:opacity-75 transition ease-in-out duration-150">
                            @endif
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('movieDetails.index', $directed['id']) }}" class="text-lg mt-2 hover:text-gray:300">{{ $directed['title'] }} ({{ date('Y', strtotime($directed['release_date'])) }})</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection
