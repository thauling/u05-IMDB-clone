<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;  
use App\Models\Movie;  

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'review_content' => $this->faker->paragraph(),
            'review_rating' => $this->faker->numberBetween(1,5),
            'user_id' => $this->faker->numberBetween(1, User::count()),//1,
            'movie_id' => $this->faker->numberBetween(1, Movie::count())//1,
        ];
    }
}
