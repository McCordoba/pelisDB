@extends('layouts.main')

@section('content')
    <h2 class="uppercase tracking-wider text-2xl font-semibold" style="color: #00e054;">Popular Movies</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
        @foreach ($popularMovies as $movie)
            <div class="mt-8 movies">
                <a href="{{ route('movieDetails.index', $movie['id']) }}">
                    <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}"
                         alt="{{ $movie['title'] }}"
                         class="w-full h-auto mb-2 hover:opacity-75 transition ease-in-out duration-150">
                </a>
                <div class="mt-2">
                    <a href="{{ route('movieDetails.index', $movie['id']) }}"
                       class="text-lg mt-2">{{ $movie['title'] }}</a>
                    <div class="flex items-center text-gray-400 text-sm mt-1">
                        <i class="fa-solid fa-star" style="color: #00e054;"></i>
                        <span class="ml-1">{{ intval($movie['vote_average'] * 10) .'%' }}</span>
                        <span class="mx-2"><i class="fa-solid fa-minus fa-rotate-90" style="color: #fff;"></i></span>
                        <span>{{ date('Y', strtotime($movie['release_date'])) }}</span>
                    </div>
                    <div class="text-gray-400 text-sm">{{ $movie['genres'] }}</div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8 text-2xl text-center font-semibold" style="color: #00e054;">
        <div class="loader">Loading <i class="fa-solid fa-spinner fa-spin-pulse"></i></div>
        <div class="no-more">No more movies <i class="fa-solid fa-heart-crack"></i></div>
    </div>

@endsection

@section('scripts')

    <script>
        let loadedPages = 0; // Track the number of loaded pages

        let elem = document.querySelector(".grid");
        let infScroll = new InfiniteScroll(elem, {
            path: function () {
                let nextPage = this.pageIndex + 1;
                return `/?page=${nextPage}`;
            },
            append: ".movies",
            status: ".page-load-status",
            history: false,
        });

        // Event listener to log when new content is appended
        infScroll.on("append", function (response, path, items) {
            loadedPages++; // Increment the loaded pages count
            console.log(`Content appended from ${path}`);

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
