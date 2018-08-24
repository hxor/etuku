<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);   
        $this->call(TypeCommoditiesTableSeeder::class);
        $this->call(TypepriceTableSeeder::class);
        $this->call(MarketsTableSeeder::class);
        $this->call(UnitsTableSeeder::class);
        $this->call(CommodityCategoriesTableSeeder::class);
        $this->call(CommoditiesTableSeeder::class);
        $this->call(CommodityPricesTableSeeder::class);
    }
}
