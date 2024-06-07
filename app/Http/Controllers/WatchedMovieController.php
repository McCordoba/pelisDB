<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WatchedMovie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WatchedMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the ID of the user currently logged in
        $userId = Auth::id();

        $watchedMovies = WatchedMovie::where('user_id', $userId)->get();

        return view('watchedMovies.index', [
            'watchedMovies' => $watchedMovies
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
        // Validates the incoming request to ensure it contains the necessary data
        $request->validate([
            'movie_id' => 'required|integer',
            'title' => 'required|string',
            'release_date' => 'required|date',
            'poster_path' => 'required|string',
        ]);

        // Store the watched movie in the database
        WatchedMovie::create([
            'user_id' => Auth::id(),
            'movie_id' => $request->input('movie_id'),
            'title' => $request->input('title'),
            'release_date' => $request->input('release_date'),
            'poster_path' => $request->input('poster_path'),
        ]);

        return response()->json([
            'message' => 'Movie watched'
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy($movieId)
    {
        // Get the id of the user currently logged in
        $userId = Auth::id();

        // Find the watched movie by its ID and the id of the user currently logged in
        $deleted = DB::delete('DELETE FROM watched_movies WHERE movie_id = ? AND user_id = ?', [$movieId, $userId]);

        if ($deleted) {
            return response()->json([
                'message' => 'Watched movie deleted successfully'
            ]);
        } else {
            return response()->json([
                'message' => 'Watched movie not found or you are not authorized to delete it'
            ], 404);
        }
    }
}
