<?php

namespace Database\Seeders;

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
        \App\Models\User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('admin123456'),
            'phone' => '124561',
            'role_id' => '1',
            'gender' => 'male',
        ]);
    }
}
