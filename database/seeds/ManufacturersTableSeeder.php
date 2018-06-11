<?php

use App\Models\Manufacturer;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ManufacturersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();
        /*DB::table('Manufacturers')->insert([
            'name' => 'Samsung',
            'category_id' => factory('App\Models\Category')->create()->id,
        ]);*/

        factory(App\Models\Manufacturer::class, 8)->create();
        /*Manufacturer::create([
            'name' => 'Samsung',
            'category_id' => factory('App\Models\Category')->create()->id,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Manufacturer::create([
            'name' => 'Huawei',
            'category_id' => factory('App\Models\Category')->create()->id,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Manufacturer::create([
            'name' => 'Acer',
            'category_id' => factory('App\Models\Category')->create()->id,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Manufacturer::create([
            'name' => 'Lenovo',
            'category_id' => factory('App\Models\Category')->create()->id,
            'created_at' => $now,
            'updated_at' => $now,
        ]);*/
    }
}
