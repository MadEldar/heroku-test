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
        \Illuminate\Support\Facades\DB::statement("INSERT INTO users (name,email,password,role,remember_token,email_verified_at,deactivated_at,created_at,updated_at) VALUES
        ('mark','admin@dailyshop.com','1',1,'E68nPawnfascX8vqnHWbjuzuSAnLTvKFm3tAlrApzMvKFrfihR8Fe7rnKsLE','2020-03-19 14:44:09.0',NULL,'2020-03-19 07:44:09.0','2020-03-19 08:02:38.0');");
    }
}
