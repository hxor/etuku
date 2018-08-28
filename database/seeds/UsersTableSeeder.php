<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::truncate();

        $data = [
            ['name' => 'Admin', 'email' => 'admin@mail.com', 'password' => bcrypt('password'), 'role' => 'admin'],
            ['name' => 'User', 'email' => 'user@mail.com', 'password' => bcrypt('password'), 'role' => 'user']
        ];

        User::insert($data);
    }
}
