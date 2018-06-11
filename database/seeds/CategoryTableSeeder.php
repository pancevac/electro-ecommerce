<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Laptops',
        ]);
        Category::create([
            'name' => 'Cameras',
        ]);
        Category::create([
            'name' => 'Smartphones',
        ]);
        Category::create([
            'name' => 'Tablets',
        ]);
        Category::create([
            'name' => 'Accessories',
        ]);
        /*factory(App\Models\Category::class, 4)->create();*/
    }
}
