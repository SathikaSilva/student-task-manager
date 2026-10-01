<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with a clean demo user account.
     */
    public function run(): void
    {
        // Create clean student user account with no initial tasks or categories
        User::firstOrCreate(
            ['email' => 'student@example.com'],
            [
                'name' => 'John Student',
                'password' => Hash::make('password'),
            ]
        );
    }
}
