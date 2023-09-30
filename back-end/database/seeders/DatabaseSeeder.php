<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Admin Le Huy Đạt',
             'email' => 'test@example.com',
             'password' => Hash::make('ledat123456'),
             'gender' => 1,
             'phone' => '111111111',
             'address' => 'Hà Nội' ,
             'status' => 1,
             'role' => 'Admin' ,
         ]);
    }
}
