<?php

use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::statement("INSERT INTO brands (brand_name,created_at,updated_at) VALUES
        ('Dr. Caroline Corkery','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0')
        ,('Allie Ullrich II','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0')
        ,('Prof. Raven Hartmann III','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0')
        ,('Dr. Dewitt Kilback','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0')
        ,('Mr. Richie Ryan I','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0')
        ,('Jalyn Skiles Jr.','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0')
        ,('Dr. Mandy Weimann DVM','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0')
        ,('Jovan Balistreri','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0')
        ,('Nia Bartoletti','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0')
        ,('Edwardo Reichel MD','2020-03-05 15:58:17.0','2020-03-05 15:58:17.0')
        ;");
    }
}
