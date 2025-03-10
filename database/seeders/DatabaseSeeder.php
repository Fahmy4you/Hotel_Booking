<?php

namespace Database\Seeders;

use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();



        Role::factory()->create([
            'name' => 'Pengunjung',
        ]);
        Role::factory()->create([
            'name' => 'Resepsonis',
        ]);
        Role::factory()->create([
            'name' => 'Admin',
        ]);
        User::factory()->create([
            'name' => 'Dani SMK 5',
            'email' => 'dani06smkn5@gmail.com',
            'password' => '12345678',
            'role_id' => 3
        ]);


    }
}
