<?php

namespace Database\Seeders;

use App\Models\Voult;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Voult::factory()->count(5)->create();
    }
}
