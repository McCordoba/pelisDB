<div class="relative mt-3 md:mt-0">
    <input
        wire:model.live.debounce.500ms="search"
        type="text"
        class="bg-gray-800 font-normal text-sm rounded-full w-64 px-4 pl-8 py-1 focus:outline-none focus:shadow-outline"
        placeholder="Search for movies/people">

    <div class="absolute top-0">
        <svg class="fill-current w-4 text-gray-500 mt-2 ml-2" viewBox="0 0 24 24">
            <path class="heroicon-ui"
                  d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"/>
        </svg>
    </div>

    @if (strlen($search) >= 2)
        <div class="absolute bg-gray-500 text-sm rounded w-64 mt-4">
            @if ($movieResults->count() > 0 || $actorResults->count() > 0)
                <h2 class="px-3 py-2 text-gray-200">Movies</h2>
                <ul>
                    @foreach ($movieResults as $result)
                        <li class="border-b border-gray-700">
                            <a href="{{ route('movieDetails.index', $result['id']) }}"
                               class="flex hover:bg-gray-700 px-3 py-3 items-center transition ease-in-out duration-150">
                                @if ($result['poster_path'])
                                    <img src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}" alt="poster"
                                         class="w-8">
                                @else
                                    <img src="https://placehold.co/50x75" alt="poster" class="w-8">
                                @endif
                                <span class="ml-4">{{ $result['title'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>

                <h2 class="px-3 py-2 text-gray-200">People</h2>
                <ul>
                    @foreach ($actorResults as $result)
                        <li class="border-b border-gray-700">
                            <a href="{{ route('actors.showActor', $result['id']) }}"
                               class="flex hover:bg-gray-700 px-3 py-3 items-center transition ease-in-out duration-150">
                                @if ($result['profile_path'])
                                    <img src="https://image.tmdb.org/t/p/w92/{{ $result['profile_path'] }}"
                                         alt="profile" class="w-8">
                                @else
                                    <img src="https://placehold.co/50x75" alt="profile" class="w-8">
                                @endif
                                <span class="ml-4">{{ $result['name'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="px-3 py-3">No results for "{{ $search }}"</div>
            @endif
        </div>
    @endif
</div>
