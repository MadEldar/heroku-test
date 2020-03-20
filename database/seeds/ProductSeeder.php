<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Product::class, 1000)->create();

        \App\Http\Controllers\User::create([
            'email' => 'root@dailyshop.com',
            'password' => '1',
            'name' => 'admin'
        ]);
    }
}
