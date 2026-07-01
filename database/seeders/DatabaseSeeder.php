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
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => 'admin',
        ]);
        User::factory()->create([
            'name' => 'manajemen',
            'email' => 'manajemen@gmail.com',
            'password' => 'password',
        ]);
        $this->call(RoleAndUserSeeder::class);
    }
}
