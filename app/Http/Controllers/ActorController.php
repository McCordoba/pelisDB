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
        // Fetch popular actors known for movies
        $actorsData = Http::get('https://api.themoviedb.org/3/person/popular?api_key=' . config('services.tmdb.token'))->json()['results'];

        // Filter out actors known for TV shows
        $filteredActors = collect($actorsData)->map(function ($actor) {
            $actor['known_for'] = collect($actor['known_for'])->filter(function ($knownFor) {
                return $knownFor['media_type'] == 'movie';
            })->toArray();
            return $actor;
        })->toArray();

        // dump($filteredActors);

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

        $social = Http::get("https://api.themoviedb.org/3/person/{$id}/external_ids?api_key=" . config('services.tmdb.token'))
            ->json();

        //dump($actorDetails);
        //dump($actorMovieCredits);
        //dump($social);

        // Calculate age
        $actorDetails['age'] = $this->calculateAge($actorDetails['birthday']);

        // Calculate age at death if both birthday and deathday exist
        if (isset($actorDetails['birthday']) && isset($actorDetails['deathday'])) {
            $actorDetails['ageOfDeath'] = $this->calculateAgeAtDeath($actorDetails['birthday'], $actorDetails['deathday']);
        }

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
            'directedMovies' => $directedMovies,
            'social' => $social
        ]);
    }

    /**
     * Calculate age from birthday.
     */
    private function calculateAge($birthday)
    {
        $birthDate = new \DateTime($birthday);
        $currentDate = new \DateTime();
        $age = $currentDate->diff($birthDate)->y;
        return $age;
    }

    /**
     * Calculate age at death from birthday and deathday.
     */
    private function calculateAgeAtDeath($birthday, $deathday)
    {
        if ($birthday && $deathday) {
            $birthDate = new \DateTime($birthday);
            $deathDate = new \DateTime($deathday);
            $ageAtDeath = $deathDate->diff($birthDate)->y;
            return $ageAtDeath;
        }
        return null;
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
