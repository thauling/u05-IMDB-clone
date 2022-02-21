<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $guarded = []; // none of the properties in movies are guarded and can hence be mass-assigned with Movie::create([assoc arr])

    //define realtionship of Movie with Review - a movie can have many reviews
    public function review()
    {
        return $this->hasMany(Review::class);
    }
=======
    protected $casts = [
        'cast' => 'array',
        'urls_images' => 'array'
    ];
>>>>>>> 866b18aac92d5a7168d44ae6c76ebc906084976d
}


