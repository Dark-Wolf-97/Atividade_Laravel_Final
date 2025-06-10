<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Urna;

class UrnaSeeder extends Seeder
{
    public function run(): void
    {
        $count = Urna::count();
        $max = 10;

        if ($count < $max) {
            Urna::factory()->count($max - $count)->create();
        }
    }
}
