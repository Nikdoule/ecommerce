<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'High Tech',
            'slug' => 'high-tech'
        ]);

        Category::create([
            'name' => 'Diy',
            'slug' => 'diy'
        ]);

        Category::create([
            'name' => 'Game',
            'slug' => 'game'
        ]);

        Category::create([
            'name' => 'Garden',
            'slug' => 'garden'
        ]);

        Category::create([
            'name' => 'Food',
            'slug' => 'food'
        ]);
    }
}
