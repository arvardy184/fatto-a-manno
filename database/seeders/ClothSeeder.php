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
        // Define the possible values for each attribute
        $types = ['Polo'];
        $colors = ['White'];
        $sizes = ['S', 'M', 'L', 'XL', 'XXL'];

        // Generate combinations and seed the database
        foreach ($types as $type) {
            foreach ($colors as $color) {
                foreach ($sizes as $size) {
                    $name = $type . ' ' . $color;
                    $this->addClothes($type, $name, $color, $size);
                }
            }
        }
    }

    private function addClothes($type, $name, $color, $size)
    {
        // Check if the same clothes exist
        $exist_clothes = Cloth::where('type', $type)
            ->where('name', $name)
            ->where('size', $size)
            ->where('color', $color)
            ->first();

        $storage = Storage::first();

        if ($exist_clothes) {

            // Assuming $cloth and $storage are instances of Cloth and Storage models respectively
            $exist_clothes->storages()->attach($storage, ['quantity' => random_int(10, 20)]);
            return;
        };

        $clothes = Cloth::factory()->withType($type)->withName($name)->withColor($color)->withSize($size)->create();

        // Assuming $cloth and $storage are instances of Cloth and Storage models respectively
        $clothes->storages()->attach($storage, ['quantity' => random_int(10, 20)]);
    }
}
