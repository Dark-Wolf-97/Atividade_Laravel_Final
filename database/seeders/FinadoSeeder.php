<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Finado;
use Illuminate\Support\Str;

class FinadoSeeder extends Seeder
{
    public function run(): void
    {
        $count = Finado::count();
        $max = 10;

        if ($count < $max) {
            Finado::factory()->count($max - $count)->create();
        }
    }
}
