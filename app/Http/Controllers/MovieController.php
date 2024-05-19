<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws ConnectionException
     */
    public function index()
    {
        $popularMovies = Http::get('https://api.themoviedb.org/3/movie/popular?api_key=' . config('services.tmdb.token'))
            ->json()['results'];

        $genres = Http::get('https://api.themoviedb.org/3/genre/movie/list?api_key=' . config('services.tmdb.token'))
            ->json()['genres'];

        // dump($popularMovies);
        // dump($genres);

        // Map genre IDs to their names for easier lookup
        $genreMap = collect($genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });

        // Add genre names to each movie
        foreach ($popularMovies as &$movie) {
            $movie['genres'] = collect($movie['genre_ids'])->map(function ($genreId) use ($genreMap) {
                return $genreMap->get($genreId);
            })->implode(', ');
        }

        return view('index', [
            'popularMovies' => $popularMovies,
            'genres' => $genres,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch detailed information about the movie using the TMDB API
        $movieDetails = Http::get("https://api.themoviedb.org/3/movie/{$id}?api_key=" . config('services.tmdb.token'))
            ->json();

        // Fetch movie credits
        $movieCredits = Http::get("https://api.themoviedb.org/3/movie/{$id}/credits?api_key=" . config('services.tmdb.token'))
            ->json();

        // Fetch genre names for the movie
        $genres = collect($movieDetails['genres'])->pluck('name')->implode(', ');

        // dump($movieDetails);

        // Extract the directors IDs and names
        $directors = collect($movieCredits['crew'])->filter(function ($crew) {
            return $crew['job'] === 'Director';
        })->map(function ($director) {
            return ['id' => $director['id'], 'name' => $director['name']];
        });

        // Extract the first 10 crew members
        $crew = collect($movieCredits['crew'])->take(10);

        // Extract the first 10 cast members
        $cast = collect($movieCredits['cast'])->take(10);

        // Add genre names, directors IDs, and names to the movie details
        $movieDetails['genres'] = $genres;
        $movieDetails['directors'] = $directors;

        // Pass the movie details to the view
        return view('movieDetails.index', [
            'movieDetails' => $movieDetails,
            'crew' => $crew,
            'cast' => $cast
        ]);
    }


    public function fetchVideos($id)
    {
        // Fetch videos for the given movie ID using TMDB API
        $response = Http::get("https://api.themoviedb.org/3/movie/{$id}/videos?api_key=" . config('services.tmdb.token'));

        if ($response->ok()) {
            $videos = $response->json()['results'];
            return response()->json(['videos' => $videos]);
        } else {
            return response()->json(['error' => 'Failed to fetch videos'], 500);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
