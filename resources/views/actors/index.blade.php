@extends('layouts.main')

@section('content')

<h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Actors</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
        @foreach ($popularActors as $actor)
            <div class="mt-8">
                  <!-- Link to the actor details page -->
                 <a href="{{ route('actors.showActor', $actor['id']) }}">
                    <img src="https://image.tmdb.org/t/p/w500{{ $actor['profile_path'] }}"
                         alt="{{ $actor['name'] }}" class="w-full h-auto mb-2 hover:opacity-75 transition ease-in-out duration-150">
                </a>
                <div class="mt-2">
                    <a href="{{ route('actors.showActor', $actor['id']) }}" class="text-lg mt-2 hover:text-gray-300">{{ $actor['name'] }}</a>
                    <div class="text-sm truncate text-gray-400">
                        @foreach ($actor['known_for'] as $movie)
                        {{$movie['title'] }}
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection



