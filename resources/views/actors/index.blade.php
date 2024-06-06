@extends('layouts.main')

@section('content')
    <h2 class="uppercase tracking-wider text-2xl font-semibold" style="color:#ee7000;">Popular Actors</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
        @foreach ($popularActors as $actor)
            <div class="mt-8 actors">
                <!-- Link to the actor details page -->
                <a href="{{ route('actors.showActor', $actor['id']) }}">
                    @if ($actor['profile_path'] )
                        <img src="https://image.tmdb.org/t/p/w500{{ $actor['profile_path'] }}"
                             alt="{{ $actor['name'] }}"
                             class="w-full h-auto mb-2 hover:opacity-75 transition ease-in-out duration-150">
                    @else
                        <img src="https://via.placeholder.com/500x750" alt="poster" class="w-64 lg:w-96">
                    @endif
                </a>
                <div class="mt-2">
                    <a href="{{ route('actors.showActor', $actor['id']) }}"
                       class="text-lg mt-2 hover:text-orange-500">{{ $actor['name'] }}</a>
                    <div class="text-sm truncate text-gray-400">
                        {{ implode(', ', array_column($actor['known_for'], 'title')) }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

<div class="mt-8 text-2xl text-center font-semibold" style="color:#ee7000;">
    <div class="loader">Loading <i class="fa-solid fa-spinner fa-spin-pulse"></i></div>
    <div class="no-more">No more actors <i class="fa-solid fa-heart-crack"></i></div>
</div>

@endsection

@section('scripts')

<script>
    let loadedPages = 0; // Track the number of loaded pages

    let elem = document.querySelector(".grid");
    let infScroll = new InfiniteScroll(elem, {
        path: function () {
            let nextPage = this.pageIndex + 1; // Increment the loaded pages count
            let filter = '{{ request()->input("filter") }}'; // Get the filter value from the current request
            return `{{ route('actors.index') }}?page=${nextPage}&filter=${filter}`;
        },
        append: ".actors",
        status: ".page-load-status",
        history: false,
    });

    // Event listener to log when new content is appended
    infScroll.on("append", function (response, path, items) {
        loadedPages++; // Increment the loaded pages count
        console.log(`Content appended from ${path} ${loadedPages} `);

        // Check if loaded pages exceed 10
        if (loadedPages >= 4) {
            // Disable loading more content, stops the infinite scroll and cleans up any event listeners and resources associated with it
            infScroll.destroy();
            // Show message indicating no more movies are loading
            document.querySelector(".no-more").style.display = "block";

            // Occult message indicating more movies are loading
            document.querySelector(".loader").style.display = "none";
        }
    });
</script>
@endsection





