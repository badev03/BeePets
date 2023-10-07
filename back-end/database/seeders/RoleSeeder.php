<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Staff']);
        Role::create(['name' => 'Doctor']);
        Role::create(['name' => 'User']);
        \App\Models\User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('admin123456'),
            'phone' => '124561',
            'role_id' => '1',
            'gender' => 'male',
        ]);
        $user = User::find(1);
        if ($user) {
            $user->assignRole('Admin');
        }
    }
}
