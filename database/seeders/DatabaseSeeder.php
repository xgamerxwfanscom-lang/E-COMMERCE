<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Empleado User',
            'email' => 'employee@example.com',
            'role' => 'employee',
        ]);

        User::factory()->create([
            'name' => 'Cliente User',
            'email' => 'client@example.com',
            'role' => 'customer',
        ]);

        $this->call(ProductSeeder::class);
    }
}
