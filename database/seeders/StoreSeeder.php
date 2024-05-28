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
        $this->storeClothes(1);
    }

    private function storeClothes(int $id)
    {
        // Create 10 users using the UserFactory
        $clothes = Cloth::all();

        $storage = Storage::find($id);

        foreach ($clothes as $cloth) {
            $cloth->storages()->attach($storage, ['quantity' => rand(1, 20)]);
        }
    }
}
