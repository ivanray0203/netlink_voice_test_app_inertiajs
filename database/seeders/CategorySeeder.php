<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Shoes',
        ]);

        Category::create([
            'name' => 'Pants',
        ]);

        Category::create([
            'name' => 'Jackets',
        ]);
        Category::create([
            'name' => 'Caps',
        ]);
        Category::create([
            'name' => 'dress',
        ]);
    }
}
