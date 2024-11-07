<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating a default admin user
        User::create([
            'name' => 'Joseph User',
            'email' => 'joseph@example.com',
            'password' => Hash::make('password'), // Make sure to hash the password
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Joseph Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Make sure to hash the password
            'role' => 'admin',
        ]);

        // // Creating regular users
        // User::create([
        //     'name' => 'Regular User 1',
        //     'email' => 'user1@example.com',
        //     'password' => Hash::make('password'), // Make sure to hash the password
        // ]);

        // User::create([
        //     'name' => 'Regular User 2',
        //     'email' => 'user2@example.com',
        //     'password' => Hash::make('password'), // Make sure to hash the password
        // ]);
    }
}
