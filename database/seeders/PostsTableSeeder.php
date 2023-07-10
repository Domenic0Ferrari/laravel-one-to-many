<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use Faker\Generator as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 50; $i++) {
            Post::create([
                'category_id' => rand(1, 5),
                'title' => $faker->word(rand(2, 10), true),
                'url_image' => 'https://picsum.photos/id/' . rand(1, 270) . '/500/400',
                'content' => $faker->paragraphs(rand(2, 20), true),
            ]);
        }
    }
}
