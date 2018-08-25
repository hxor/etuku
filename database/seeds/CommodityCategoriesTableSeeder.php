<?php

use Illuminate\Database\Seeder;
use App\Models\CommodityCategory as ComCat;

class CommodityCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ComCat::truncate();

        $data = [
            [
                'type_commodity_id' => 1, 
                'slug' => 'beras', 
                'title' => 'Beras'
            ],
            [
                'type_commodity_id' => 2,
                'slug' => 'daging-sapi',
                'title' => 'Daging Sapi'
            ]
        ];

        ComCat::insert($data);
    }
}
