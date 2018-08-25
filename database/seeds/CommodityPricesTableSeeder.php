<?php

use Illuminate\Database\Seeder;
use App\Models\CommodityPrice as ComPrice;

class CommodityPricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ComPrice::truncate();

        $data = [
            [
                'type_price_id' => 1, 
                'commodity_id' => 1, 
                'market_id' => 1, 
                'price' => 10000, 
                'gap' => 0, 
                'date' => '2018-08-1', 
                'status' => 'equal'
            ], [
                'type_price_id' => 1,
                'commodity_id' => 1,
                'market_id' => 1,
                'price' => 11000,
                'gap' => 1000,
                'date' => '2018-08-2',
                'status' => 'up'
            ], [
                'type_price_id' => 1,
                'commodity_id' => 1,
                'market_id' => 1,
                'price' => 9000,
                'gap' => 2000,
                'date' => '2018-08-3',
                'status' => 'down'
            ], [
                'type_price_id' => 1,
                'commodity_id' => 1,
                'market_id' => 1,
                'price' => 9000,
                'gap' => 0,
                'date' => '2018-08-4',
                'status' => 'equal'
            ]
        ];

        ComPrice::insert($data);
    }
}
