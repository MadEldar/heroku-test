<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Http\Controllers\User::create([
            'email' => 'root@dailyshop.com',
            'password' => '1',
            'name' => 'admin',
            'role' => 1
        ]);
    }
}
