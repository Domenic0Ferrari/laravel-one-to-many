<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Uncategorized',
                'description' => 'Lorem ipsum'
            ],
            [
                'name' => 'Politica',
                'description' => 'Lorem ipsum'
            ],
            [
                'name' => 'Attualità',
                'description' => 'Lorem ipsum'
            ],
            [
                'name' => 'Informatica',
                'description' => 'Lorem ipsum'
            ],
            [
                'name' => 'Scuola',
                'description' => 'Lorem ipsum'
            ],
            [
                'name' => 'Cronaca',
                'description' => 'Lorem ipsum'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
