<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $guarded = []; // none of the properties in movies are guarded and can hence be mass-assigned with Movie::create([assoc arr])

    //define realtionship of Movie with Review - a movie can have many reviews
    public function review()
    {
        return $this->hasMany(Review::class);
    }
    protected $casts = [
        'cast' => 'array',
        'urls_images' => 'array'
    ];
}


