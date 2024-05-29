<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ActorController;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\WatchedMovieController;
use App\Http\Controllers\LikedMovieController;
use App\Http\Controllers\WatchListController;
use App\Http\Controllers\ReviewController;

// Routes for the movies
Route::get('/', [MovieController::class, 'index'])->name('index'); // This is the main page of the app
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movieDetails.index');
Route::get('/movies/{id}/videos', [MovieController::class, 'fetchVideos'])->name('movies.videos');

// Routes for the actors
Route::get('actors', [ActorController::class, 'index'])->name('actors.index');
Route::get('/actors/{id}', [ActorController::class, 'show'])->name('actors.showActor');

// Routes for login and register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Middleware to protect routes that require authentication
Route::middleware(['auth'])->group(function () {

    // Define routes that require authentication within this group
    // Routes for users
    // Using the method resource() laravel automatically generates the necessary routes for common CRUD operations
    // Route::resource('users', UserController::class);
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

    Route::post('/users/update', [UserController::class, 'update'])->name('users.update');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Routes for the watched movies
    Route::post('/watched-movies', [WatchedMovieController::class, 'store']);
    Route::delete('/watched-movies/{id}', [WatchedMovieController::class, 'destroy']);

    // Routes for the liked movies
    Route::post('/liked-movies', [LikedMovieController::class, 'store']);
    Route::delete('/liked-movies/{id}', [LikedMovieController::class, 'destroy']);

    // Routes for the movies on the watchlist
    Route::post('/watchlist', [WatchListController::class, 'store']);
    Route::delete('/watchlist/{id}', [WatchListController::class, 'destroy']);

    // Routes for the reviews
    Route::post('/review', [ReviewController::class, 'store']);
    Route::delete('/review/{id}', [ReviewController::class, 'destroy']);
    Route::get('/review/{id}', [ReviewController::class, 'show']);
    Route::put('/review/{id}', [ReviewController::class, 'update']);

    Route::get('/reviews/{movieId}', [ReviewController::class, 'showReviews']);
});

