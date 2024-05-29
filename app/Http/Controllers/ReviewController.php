<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Show all reviews for a specific movie
    public function index()
    {
        //
    }

    // Show all reviews for a specific movie
    public function showReviews($movieId)
    {

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
            'review' => 'required|string',
            'score' => 'numeric|nullable',] , [
                'review.required' => 'The review must contain text at least.',

            ]);

        Review::create([
            'user_id' => Auth::id(),
            'movie_id' => $request->input('movie_id'),
            'title' => $request->input('title'),
            'release_date' => $request->input('release_date'),
            'poster_path' => $request->input('poster_path'),
            'review' => $request->input('review'),
            'score' => $request->input('score'),
        ]);


        return response()->json([
            'message' => 'Review submitted successfully'
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show($movieId)
    {
        $userId = Auth::id();
        $review = Review::where('movie_id', $movieId)
            ->where('user_id', $userId)
            ->first();

        if ($review) {
            return response()->json([
                'review' => $review
            ], 200);
        } else {
            return response()->json([
                'message' => 'Review not found'
            ], 404);
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
        // Validates the incoming request to ensure it contains the necessary data
        $request->validate([
            'movie_id' => 'required|integer',
            'title' => 'required|string',
            'release_date' => 'required|date',
            'poster_path' => 'required|string',
            'review' => 'required|string',
            'score' => 'numeric|nullable',
        ]);

        // Find the review by movie ID and user ID
        $review = Review::where('movie_id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Update the review with new data
        $review->update([
            'title' => $request->input('title'),
            'release_date' => $request->input('release_date'),
            'poster_path' => $request->input('poster_path'),
            'review' => $request->input('review'),
            'score' => $request->input('score'),
        ]);

        return response()->json([
            'message' => 'Review updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($movieId)
    {
        // Get the id of the user currently logged in
        $userId = Auth::id();

        // Find the movie by its ID and the id of the user currently logged in
        $deleted = DB::delete('DELETE FROM reviews WHERE movie_id = ? AND user_id = ?', [$movieId, $userId]);

        if ($deleted) {
            return response()->json([
                'message' => 'Review deleted successfully'
            ]);
        } else {
            return response()->json([
                'message' => 'Review not found or you are not authorized to delete it'
            ], 404);
        }
    }
}
