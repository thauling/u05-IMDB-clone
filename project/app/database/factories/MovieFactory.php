<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'genre' => $this->faker->sentence(),
            'cast' => json_encode(array($this->faker->name(), $this->faker->name(), $this->faker->name())),
            'abstract' => $this->faker->paragraph(),
            'urls_images' => json_encode(array($this->faker->imageUrl(100,100), $this->faker->imageUrl(100,100))), //file >
            'url_trailer' => $this->faker->imageUrl(100,100),
            'avg_rating' => 5/$this->faker->numberBetween(1,5) // 1 - 5 to avoid div by 0
        ];
    }
}
