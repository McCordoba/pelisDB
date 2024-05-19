<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ActorController;

use App\Http\Controllers\UserController;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

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
    // Route::resource('likedMovies', LikedMovieController::class);
    Route::resource('users', UserController::class);

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // TODO this route will be for the admins
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

