<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        User::create([
            'fname' => 'Admin',
            'lname' => 'User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => '2',
        ]);

        User::create([
            'fname' => 'Upcycler',
            'lname' => 'User',
            'email' => 'upcycler@example.com',
            'password' => Hash::make('password123'),
            'role' => '1',
        ]);

          User::create([
            'fname' => 'Regular',
            'lname' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'role' => '0',
        ]);
    }
}
