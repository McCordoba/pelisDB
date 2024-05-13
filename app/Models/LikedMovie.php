<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LikedMovie extends Model
{
    use HasFactory;

    //
    protected $fillable = [
        'user_id', 'title', 'movie_id'
    ];

    // Cast timeStamp to datetime
    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime'
    ];

    // Relationship
    // One to many
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
