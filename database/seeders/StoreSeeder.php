<?php

namespace Database\Seeders;

use App\Models\Cloth;
use App\Models\Storage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 clothes using the ClothFactory
        Cloth::factory(10)->create();

        $this->storeClothes(1);
    }

    private function storeClothes(int $id)
    {
        $clothes = Cloth::all();
        $storage = Storage::find($id);
        foreach ($clothes as $cloth) {
            $cloth->storages()->attach($storage, ['quantity' => rand(30, 50)]);
        }
    }
}