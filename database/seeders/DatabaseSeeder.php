<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categories;
use App\Models\Posts;
use App\Models\Comments;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Categories::factory(50)->create();
        Posts::factory(2000)->create()->each(function ($post) {
            Comments::factory(3)->create(['post_id' => $post->id]);
        });

    }
}
