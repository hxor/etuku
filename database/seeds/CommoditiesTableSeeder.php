<?php

use Illuminate\Database\Seeder;
use App\Models\Commodity;

class CommoditiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Commodity::truncate();

        $data = [
            [
                'commodity_category_id' => 1,
                'unit_id' => 1,
                'slug' => 'beras',
                'title' => 'Beras', 
                'status' => 1
            ], [
                'commodity_category_id' => 2,
                'unit_id' => 1,
                'slug' => 'daging-sapi',
                'title' => 'Daging Sapi',
                'status' => 1
            ],
        ];

        Commodity::insert($data);
    }
}
