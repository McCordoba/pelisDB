<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch popular actors known for movies from TMDb API
        $actorsData = Http::get('https://api.themoviedb.org/3/person/popular?api_key=' . config('services.tmdb.token'))->json()['results'];

        // Filter out actors known for TV shows
        $filteredActors = collect($actorsData)->map(function ($actor) {
            $actor['known_for'] = collect($actor['known_for'])->filter(function ($knownFor) {
                return $knownFor['media_type'] == 'movie';
            })->toArray();
            return $actor;
        })->toArray();

        dump($filteredActors);

        // Pass the filtered actors data to the view
        return view('actors.index', [
            'popularActors' => $filteredActors,
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
        $actorDetails = Http::get("https://api.themoviedb.org/3/person/{$id}?api_key=" . config('services.tmdb.token'))
            ->json();

        $actorMovieCredits = Http::get("https://api.themoviedb.org/3/person/{$id}/movie_credits?api_key=" . config('services.tmdb.token'))
            ->json();

        dump($actorDetails);
        dump($actorMovieCredits);

        // Extract the first 20 movies that the actor starred sorted by popularity
        $movies = collect($actorMovieCredits['cast'])->take(20)->sortByDesc('popularity');

        // Extract the directed movies and sort them by popularity
        $directedMovies = collect($actorMovieCredits['crew'])->filter(function ($crew) {
            return $crew['job'] === 'Director';
        })->take(20)->sortByDesc('popularity');

        return view('actors.showActor', [
            'actorDetails' => $actorDetails,
            'actorMovieCredits' => $actorMovieCredits,
            'movies' => $movies,
            'directedMovies' => $directedMovies
        ]);
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
