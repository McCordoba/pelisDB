@extends('layouts.main')

@section('content')
    <h1 class="text-3xl font-bold underline">
        Liked Movies
    </h1>

    @foreach ($likedMovies as $likedMovie)
        {{$likedMovie}}
    @endforeach
@endsection

