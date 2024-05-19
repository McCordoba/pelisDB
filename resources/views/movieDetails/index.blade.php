@extends('layouts.main')


@section('content')
    <div class="movie-info border-b border-gray-500">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <div class="flex-none">
                <img src="https://image.tmdb.org/t/p/w500{{ $movieDetails['poster_path'] }}"
                     alt="{{ $movieDetails['title'] }}" class="w-64 lg:w-96">
            </div>

            <div class="md:ml-24">
                <h2 class="text-4xl mt-4 md:mt-0 font-semibold">{{ $movieDetails['title'] }}</h2>
                <h1 class="mt-4 md:mt-0 font-semibold text-gray-400">Original title: {{ $movieDetails['original_title'] }}</h1>
                <div class="flex flex-wrap items-center text-gray-400 text-sm">
                    <i class="fa-solid fa-star" style="color: #00e054;"></i>
                    <span class="ml-1">{{ intval($movieDetails['vote_average'] * 10) .'%' }}</span>
                    <span class="mx-2"><i class="fa-solid fa-minus fa-rotate-90" style="color: #fff;"></i></span>
                    <span>{{ date('Y', strtotime($movieDetails['release_date'])) }}</span>
                    <span class="mx-2"><i class="fa-solid fa-minus fa-rotate-90" style="color: #fff;"></i></span>
                    <span>{{ $movieDetails['runtime'] }} mins</span>
                    <span class="mx-2"><i class="fa-solid fa-minus fa-rotate-90" style="color: #fff;"></i></span>
                    <span>{{ $movieDetails['genres'] }}</span>
                </div>

                <p class="text-gray-300 mt-8">
                    Directed by
                    @foreach($movieDetails['directors'] as $director)
                        <b><a href="{{ route('actors.showActor', $director['id']) }}">{{ $director['name'] }}</a></b>
                        @if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </p>

                <p class="text-gray-300 mt-8">
                    {{ $movieDetails['overview'] }}
                </p>

                {{-- Button to open the modal with a trailer--}}
                <div class="mt-12">
                    <button id="playTrailerBtn"
                            class="flex items-center rounded font-semibold px-5 py-4 transition ease-in-out duration-150"
                            data-movie-id="{{ $movieDetails['id'] }}">
                        <svg class="w-6 fill-current" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0z" fill="none"/>
                            <path
                                    d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                        </svg>
                        <span class="ml-2">Play Trailer</span>
                    </button>
                </div>

                <div class="mt-12">
                    <h4 class="text-white font-semibold">Crew</h4>
                    <div class="flex mt-4">
                        <ul>
                            @foreach ($crew as $member)
                                <li>{{ $member['name'] }} -
                                    <span class="text-sm text-gray-400">{{ $member['job'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="movie-cast border-b border-gray-500">
        <div class="container mx-auto px-4 py-16">

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                <button
                        class="flex items-center rounded font-semibold px-5 py-4 transition ease-in-out duration-150">
                    <i class="fa-regular fa-eye"></i>
                    <span class="ml-2">Watch</span>
                </button>

                <button
                        class="flex items-center rounded font-semibold px-5 py-4 transition ease-in-out duration-150">
                    <i class="fa-regular fa-heart"></i>
                    <span class="ml-2">Like</span>
                </button>

                <button
                        class="flex items-center rounded font-semibold px-5 py-4 transition ease-in-out duration-150">
                    <i class="fa-regular fa-clock"></i>
                    <span class="ml-2">Watchlist</span>
                </button>

                <button
                        class="flex items-center rounded font-semibold px-5 py-4 transition ease-in-out duration-150">
                    <i class="fa-regular fa-message"></i>
                    <span class="ml-2">Review</span>
                </button>

                {{-- TODO INSIDE THE MODAL REVIEW
                    Will be a form to put the text and a option to rate it --}}
                <button
                        class="flex items-center rounded font-semibold px-5 py-4 transition ease-in-out duration-150">
                    <i class="fa-regular fa-star"></i>
                    <span class="ml-2">Rate</span>
                </button>

            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-semibold">Cast</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($cast as $actor)
                <div class="mt-8">
                    <a href="{{ route('actors.showActor', $actor['id']) }}">
                        @if ($actor['profile_path'])
                            <img src="https://image.tmdb.org/t/p/w500{{ $actor['profile_path'] }}"
                                 alt="{{ $actor['name'] }}"
                                 class="hover:opacity-75 transition ease-in-out duration-150">
                        @else
                            <img src="https://placehold.co/300x450?text={{ $actor['name'] }}"
                                 class="hover:opacity-75 transition ease-in-out duration-150">
                        @endif

                    </a>
                    <div class="mt-2">
                        <a href="{{ route('actors.showActor', $actor['id']) }}"
                           class="text-lg mt-2 hover:text-gray:300">{{ $actor['name'] }}</a>
                        <div class="text-sm text-gray-400">
                            {{ $actor['character'] }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </div>

    {{-- MODAL FOR THE TRAILER --}}
    <div id="modal" class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto">
        <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto bg-gray-900/50">
            <div class="flex justify-end pr-4 pt-2">
                <button id="closeBtn" class="text-3xl leading-none hover:text-gray-300"><i class="fa-solid fa-x fa-xs"
                                                                                           style="color: #ffffff;"></i>
                </button>
            </div>
            <div class="modal-body px-8 py-8">
                <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                    <iframe id="iframe" class="responsive-iframe absolute top-0 left-0 w-full h-full" style="border:0;"
                            encrypted-media
                    " allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

@endsection


