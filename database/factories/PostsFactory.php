<?php

namespace Database\Factories;

use App\Models\Posts;
use App\Models\Categories;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posts>
 */
class PostsFactory extends Factory
{
    protected $model = Posts::class;

    public function definition()
    {
        return [
            'category_id' => Categories::factory(),
            'post_title' => $this->faker->sentence,
            'post_content' => $this->faker->paragraph,
        ];
    }
}
