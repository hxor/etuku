<?php

use Illuminate\Database\Seeder;
use App\Models\Market;

class MarketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Market::truncate();

        $data = [
            ['slug' => 'pasar-kanoman', 'title' => 'Pasar Kanoman'],
            ['slug' => 'pasar-jagasatru', 'title' => 'Pasar Jagasatru']
        ];

        Market::insert($data);
    }
}
