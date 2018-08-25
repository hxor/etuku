<?php

use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Unit::truncate();

        $data = [
            ['slug' => 'kg', 'title' => 'Kg']
        ];

        Unit::insert($data);
    }
}
