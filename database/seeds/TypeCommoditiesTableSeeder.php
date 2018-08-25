<?php

use Illuminate\Database\Seeder;
use App\Models\TypeCommodity as TypeCom;

class TypeCommoditiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // TypeCom::truncate();

        $data = [
            ['slug' => 'bahan-pangan', 'title' => 'Bahan Pangan'],
            ['slug' => 'hewan-ternak', 'title' => 'Hewan Ternak']
        ];

        TypeCom::insert($data);
    }
}
