<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run()
{
    // Akun Admin
    \App\Models\User::create([
        'name' => 'Admin Toko',
        'email' => 'admin@mail.com',
        'password' => bcrypt('password'),
        'role' => 'admin',
    ]);

    // Akun User Biasa
    \App\Models\User::create([
        'name' => 'Budi User',
        'email' => 'user@mail.com',
        'password' => bcrypt('password'),
        'role' => 'user',
    ]);

    $this->call(ItemSeeder::class);
}
}
