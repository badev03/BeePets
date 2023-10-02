<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Doctor::factory()->create([
            'email' => 'doctor@example.com',
            'password' => Hash::make('doctor123456'),
            'phone' => '124561',
            'gender' => 'male',
            'name' => 'doctor'
        ]);
    }
}
