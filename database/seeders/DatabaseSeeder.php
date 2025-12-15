<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat User Admin
        User::firstOrCreate(
            ['email' => 'admin@dlh.com'],
            [
                'name' => 'Admin DLH',
                'password' => Hash::make('password'), // password: password
            ]
        );

        $this->call([
            NewsSeeder::class,
            FeedbackSeeder::class,
        ]);
    }
}