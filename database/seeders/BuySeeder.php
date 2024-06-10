<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Cloth;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BuySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Retrieve existing users and clothes
        $users = User::all();
        $clothes = [];
        $i = Cloth::orderBy('id', 'desc')->first()->id;
        while (count($clothes) < 10) {
            $clothes[] = Cloth::find(rand(1, (int) $i));
        }

        // Seed pivot data
        $users->each(function ($user) use ($clothes) {
            $idx = rand(0, 9);
            $quantity = rand(1, 5);

            // Attach a random cloth to the user with the specified quantity
            $user->cloth()->attach($clothes[$idx], [
                'quantity' => $quantity,
                'payment_method' => 'Credit Card', // Example payment method
                'payment_status' => rand(0, 1), // Example payment status
                'confirmation_status' => rand(0, 1)
            ]);
        });
    }
}
