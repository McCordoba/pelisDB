@extends('layouts.main')


@section('content')
<div class="movie-info border-b border-gray-800">
    <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
        <div class="flex-none">
            <img src="https://image.tmdb.org/t/p/w500{{ $actorDetails['profile_path'] }}"  alt="{{ $actorDetails['name'] }}" class="w-64 lg:w-96">
        </div>


        <div class="md:ml-24">
            <h2 class="text-4xl mt-4 md:mt-0 font-semibold">{{ $actorDetails['name'] }}</h2>
            <div class="flex flex-wrap items-center text-gray-400 text-sm">
            </div>

            <p class="text-gray-300 mt-8">
                {{ $actorDetails['biography'] }}
            </p>

        </div>

    </div>
</div>

    <div class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-semibold">Credits</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">

        </div>
    </div>

@endsection


