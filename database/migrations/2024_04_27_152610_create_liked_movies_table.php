<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('liked_movies', function (Blueprint $table) {
            $table->id();

            // Creates a foreign Key
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Id of the movie fetched from the API tmdb
            $table->integer('movie_id');

            // Title of the movie
            $table->string('title');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liked_movies');
    }
};
