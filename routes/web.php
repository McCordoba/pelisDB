<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ActorController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\LikedMovieController;

// Routes for the movies
Route::get('/', [MovieController::class, 'index'])->name('index'); // This is the main page of the app

Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movieDetails.index');

// Routes for the actors
Route::get('actors', [ActorController::class, 'index']);
Route::get('/actors/{id}', [ActorController::class, 'show'])->name('actors.showActor');


// Routes for users
// Using the method resource() laravel automatically generates the necessary routes for common CRUD operations
Route::resource('users', UserController::class);
// Route::resource('likedMovies', LikedMovieController::class);

//Route::post('/api/v1/movie/like', [LikedMovieController::class, 'store']);


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::view('/', 'index');
