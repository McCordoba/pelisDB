<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LikedMovie;

class LikedMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          // Displays all the likedMovies
        // $users = User::all();

        // Displays a certain number of likedMovies per page
        // paginate() default value is 15
        $likedMovies = LikedMovie::paginate();

        return view('users.likedMovies', [
            'likedMovies' => $likedMovies
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
        print_r($request->getContent());

        return response()->json([
            "success" => true,
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
    public function destroy(string $id)
    {
        //
    }
}
