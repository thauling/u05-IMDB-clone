<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $guarded = ['content', 'rating', 'user_id', 'movie_id']; //could also use protected $fillable = ['prob1', 'prob2', 'etc'];

    // define relationship of this model/ table with User and Movie
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
