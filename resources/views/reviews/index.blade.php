@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h3 class="text-2xl font-semibold">Reviews by {{ $user->name }}</h3>
        @if ($reviews->isEmpty())
            <p class="text-gray-400">No reviews yet.</p>
        @else
            <div class="py-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($reviews as $review)
                    <div class="bg-gray-800 p-4 rounded-lg shadow-md">
                        <div class="mb-2">
                            <p><a href="{{ route('movieDetails.index', $review->movie_id) }}"
                                  class="text-lg font-semibold hover:text-gray-300">{{ $review->title }}
                                    ({{ date('Y', strtotime($review->release_date)) }})</a></p>
                            <span class="text-gray-500">{{ $review->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="text-gray-300">
                            @if ($review->score )
                                <div class="rating mt-2">
                                    <p class="font-semibold">
                                        <i class="fa-solid fa-star"
                                           style="color: #00e054;"></i> {{ intval( $review->score * 10) .'%' }}
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
@endsection
