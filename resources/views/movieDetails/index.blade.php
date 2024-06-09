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
                <h1 class="mt-4 md:mt-0 font-semibold text-gray-400">Original
                    title: {{ $movieDetails['original_title'] }}</h1>
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
                        <b><a class="link"
                              href="{{ route('actors.showActor', $director['id']) }}">{{ $director['name'] }}</a></b>
                        @if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </p>

                <p class="text-gray-300 mt-8">
                    {{ $movieDetails['overview'] }}
                </p>

                {{-- Button to open the modal with a trailer --}}
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

                <div class="mt-12 flex">
                    {{-- Crew List --}}
                    <div>
                        <h2 class="text-lg text-white font-semibold">Crew</h2>
                        <div class="flex mt-4">
                            <ul>
                                @foreach ($crew as $member)
                                    <li>
                                        <a href="{{ route('actors.showActor', $member['id']) }}"
                                        class="hover:text-gray:300">{{ $member['name'] }}</a> -
                                        <span class="text-sm text-gray-400">{{ $member['job'] }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    {{-- USER ACTIONS --}}
                    <div class="flex flex-col ml-36">
                        <ul>
                            <!-- Check if the user is authenticated -->
                            @auth
                                <li class="mb-4">
                                    <button
                                        class="watch flex items-center rounded font-semibold w-48 h-12 justify-center transition ease-in-out duration-150 {{ $movieDetails['whatched'] ? 'whatched' : '' }}"
                                        data-movie-id="{{ $movieDetails['id'] }}"
                                        data-movie-title="{{ $movieDetails['title'] }}"
                                        data-release-date="{{ $movieDetails['release_date'] }}"
                                        data-poster-path="{{ $movieDetails['poster_path'] }}">
                                        <i class="fa-regular fa-eye"></i>
                                        <span
                                            class="ml-2">{{ $movieDetails['whatched'] ? 'Whatched' : 'Whatch' }}</span>
                                    </button>
                                </li>
                                <li class="mb-4">
                                    <button
                                        class="like flex items-center rounded font-semibold w-48 h-12 justify-center transition ease-in-out duration-150 {{ $movieDetails['liked'] ? 'liked' : '' }}"
                                        data-movie-id="{{ $movieDetails['id'] }}"
                                        data-movie-title="{{ $movieDetails['title'] }}"
                                        data-release-date="{{ $movieDetails['release_date'] }}"
                                        data-poster-path="{{ $movieDetails['poster_path'] }}">
                                        <i class="fa-regular fa-heart"></i>
                                        <span class="ml-2">{{ $movieDetails['liked'] ? 'Liked' : 'Like' }}</span>
                                    </button>
                                </li>
                                <li class="mb-4">
                                    <button
                                        class="watchlist flex items-center rounded font-semibold w-48 h-12 justify-center transition ease-in-out duration-150 {{ $movieDetails['listed'] ? 'listed' : '' }}"
                                        data-movie-id="{{ $movieDetails['id'] }}"
                                        data-movie-title="{{ $movieDetails['title'] }}"
                                        data-release-date="{{ $movieDetails['release_date'] }}"
                                        data-poster-path="{{ $movieDetails['poster_path'] }}">
                                        <i class="fa-regular fa-bookmark"></i>
                                        <span class="ml-2">{{ $movieDetails['listed'] ? 'Listed' : 'Watchlist' }}</span>
                                    </button>
                                </li>
                                {{-- Opens the MODAL REVIEW --}}
                                <li class="mb-4">
                                    <button
                                        id="reviewModalBtn"
                                        class="flex items-center rounded font-semibold w-48 h-12 justify-center transition ease-in-out duration-150">
                                        <i class="fa-regular fa-message"></i>
                                        <span class="ml-2">Write a review</span>
                                    </button>
                                </li>
                            @endauth

                            <!-- Check if the user is NOT authenticated -->
                            @guest
                                <li class="mb-4">
                                    <button
                                        class="flex items-center rounded font-semibold w-48 h-12 justify-center transition ease-in-out duration-150">
                                    <span class="ml-2">
                                        <a class="movieLog"
                                           href="{{ route('login') }}">Sign in to log, rate or review</a>
                                    </span>
                                    </button>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="movie-info-cast border-b border-gray-500">
        <div class="container mx-auto px-4 py-8">
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

    <div class="container mx-auto px-4 py-8">
        <h2 class="text-4xl font-semibold">Reviews</h2>
        @if ($reviews->isEmpty())
            <p class="text-gray-400 text-lg pt-2">No reviews yet. Be the first to review this movie!</p>
        @else
            <div class="py-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($reviews as $review)
                    <div class="bg-gray-800 p-4 rounded-lg shadow-md">
                        <div class="mb-2">
                            <h3 class="text-lg font-bold">{{ $review->user->name }}</h3>
                            <span class="text-gray-500">{{ $review->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="text-gray-300">
                            @if ($review->score )
                                <div class="rating mt-2">
                                    <p class="font-semibold"><i class="fa-solid fa-star" style="color: #00e054;"></i>
                                        {{ intval( $review->score * 10) .'%' }}
                                    </p>
                                </div>
                            @endif
                            <p class="text-gray-400 overflow-hidden review-text"
                               style="max-height: 4.5rem; line-height: 1.5rem;">{{ $review->review }}</p>
                            <a class="mt-2 text-toggle">Read more <i class="fa-solid fa-arrow-right" ;"></i></a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- MODAL FOR THE REVIEW --}}
    <div id="modalReview" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-900/50">
        <div class="container py-16 mx-auto lg:px-32 rounded-lg overflow-y-auto bg-gray-900/50">
            <div class="flex justify-end pr-4 pt-2">
                <button id="closeBtnRW" class="closeBtn text-3xl leading-none">
                    <i class="fa-solid fa-x fa-xs"></i>
                </button>
            </div>
            <div class="modal-body px-8 py-8 flex justify-center">
                <div class="max-w-md mx-auto bg-gray-800 rounded-lg overflow-hidden shadow-lg p-6 flex flex-wrap">
                    <h1 class="w-full text-2xl font-bold mb-4">Write a review</h1>

                    <form id="reviewForm" method="" action="" class="w-full flex flex-wrap">
                        @csrf
                        <div class="w-full mb-4">
                            <label for="review" class="block text-gray-300">Review</label>
                            <textarea name="review" id="review" cols="30" rows="5" required
                                      class="mt-1 block w-full rounded-md px-4 py-1 bg-gray-800 shadow-sm focus:border-[var(--two)] focus:ring focus:outline-none focus:ring-[var(--two)] focus:ring-opacity-50"></textarea>
                        </div>
                        <div class="w-full mb-4">
                            <label for="score" class="block text-gray-300">Rating (Optional)</label>
                            <span class="text-green-500 text-sm">Rate 1 to 10</span>
                            <input type="number" id="score" name="score" min="1" max="10" placeholder="1.00" step="0.5"
                                   class="mt-1 block w-full rounded-md px-4 py-1 bg-gray-800 shadow-sm focus:border-[var(--two)] focus:ring focus:outline-none focus:ring-[var(--two)] focus:ring-opacity-50">
                        </div>
                        <div class="flex w-full justify-center">
                            <button id="editReviewButton"
                                    class="edit-review-button py-2 px-4 flex items-center rounded font-semibold h-12 justify-center transition ease-in-out duration-150 mt-2 mr-2 ">
                                <i class="fa-regular fa-pen-to-square"></i>
                                <span class="ml-2">Edit</span>
                            </button>
                            <button id="reviewButton" type="submit"
                                    class="review py-2 px-4 flex items-center rounded font-semibold h-12 justify-center transition ease-in-out duration-150 mt-2 {{ $movieDetails['reviewed'] ? 'reviewed' : '' }}"
                                    data-movie-id="{{ $movieDetails['id'] }}"
                                    data-movie-title="{{ $movieDetails['title'] }}"
                                    data-release-date="{{ $movieDetails['release_date'] }}"
                                    data-poster-path="{{ $movieDetails['poster_path'] }}">
                                <i class="fa-regular fa-message"></i>
                                <span class="ml-2">{{ $movieDetails['reviewed'] ? 'Reviewed' : 'Review' }}</span>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- MODAL FOR THE TRAILER --}}
    <div id="modalTrailer" class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto">
        <div class="container py-16 mx-auto lg:px-32 rounded-lg overflow-y-auto bg-gray-900/50">
            <div class="flex justify-end pr-4 pt-2">
                <button id="closeBtnMT" class="closeBtn text-3xl leading-none">
                    <i class="fa-solid fa-x fa-xs"></i>
                </button>
            </div>
            <div class="modal-body px-8 py-8">
                <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                    <iframe id="iframe" class="responsive-iframe absolute top-0 left-0 w-full h-full" style="border:0;" encrypted-media allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

@endsection


