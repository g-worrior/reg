<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\User;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Post::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), //Generates a User from factory and extracts id
            'title' => $this->faker->sentence, //Generates a fake sentence
            'body' => $this->faker->paragraph(30) //generates fake 30 paragraphs
        ];
    }
}
