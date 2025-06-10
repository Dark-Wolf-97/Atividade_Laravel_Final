<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            FinadoSeeder::class,
            UrnaSeeder::class,
        ]);
    }
}
