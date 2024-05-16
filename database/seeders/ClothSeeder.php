<?php

namespace Database\Seeders;

use App\Models\Cloth;
use App\Models\Storage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClothSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clothes = Cloth::factory()->count(10)->create();
    }
}
