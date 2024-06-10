<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Database\Seeders\UserSeeder;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

      /** @test */
    public function it_can_get_user_by_id()
    {
        // Jalankan seeder
        $this->seed(UserSeeder::class);

        // Dapatkan pengguna dari database
        $user = User::first();

        // Kirim permintaan untuk mendapatkan pengguna berdasarkan ID
        $response = $this->get('/api/user/' . $user->id);

        // Lakukan assertion
        $response->assertStatus(200)
        ->assertJson([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'address' => $user->address,
                'role_id' => $user->role_id
            ]
        ]);
    

    }

/** @test */
public function it_can_get_all_users()
{
      // Jalankan seeder
      $this->seed(UserSeeder::class);

    // Memeriksa apakah database terisi
    $this->assertDatabaseCount('users', 1);

    $user = User::all();

    // Mengirim permintaan untuk mendapatkan semua pengguna
    $response = $this->get('/api/user/all');

    // Memeriksa bahwa permintaan berhasil (status kode 200)
    $response->assertStatus(200);

    // Memeriksa bahwa respons adalah JSON
    $response->assertHeader('Content-Type', 'application/json');

    // Memeriksa bahwa jumlah pengguna yang dikembalikan sesuai dengan yang diharapkan
    $response->assertJsonCount(1);

    // Memeriksa bahwa setiap item dalam respons memiliki atribut yang diharapkan
    $response->assertStatus(200)
    ->assertJsonFragment([
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'address' => $user->address,
        'number' => $user->number,
        'role_id' => $user->role_id
    ]);

    
    
}

    /** @test */
    public function it_returns_404_if_user_not_found()
    {
        $response = $this->get('/api/user/2');

        $response->assertStatus(404);
    }
}
