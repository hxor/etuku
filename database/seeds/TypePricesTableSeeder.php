<?php

use Illuminate\Database\Seeder;
use App\Models\TypePrice;

class TypepriceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypePrice::truncate();

        $data = [
            ['slug' => 'harga-grosir', 'title' => 'Harga Grosir'],
            ['slug' => 'harga-ecer', 'title' => 'Harga Ecer']
        ];

        TypePrice::insert($data);
    }
}
