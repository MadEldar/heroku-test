<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::statement("INSERT INTO categories (category_name,created_at,updated_at) VALUES
        ('Quincy Morar','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0')
        ,('Elfrieda Runolfsdottir Sr.','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0')
        ,('Nicolas Dicki','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0')
        ,('Dagmar Weimann III','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0')
        ,('Pink Jerde','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0')
        ,('Berneice Watsica','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0')
        ,('Prof. Jaylan Wehner V','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0')
        ,('Reba Sanford','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0')
        ,('Agustin Kessler','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0')
        ,('Vincenza Ortiz','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0'),
        ('Marquis Hackett IV','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0')
        ,('Lacey Steuber Sr.','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0')
        ,('Jimmy Schmidt','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0')
        ,('Daphnee Stokes','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0')
        ,('Maximus West','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0')
        ,('Prof. Morris Gleichner','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0')
        ,('Shanna Rowe','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0')
        ,('Prof. Adela Hoeger','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0')
        ,('Mr. Torrey Hansen','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0')
        ,('Dr. Raven O''Kon V','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0')
        ;");
    }
}
