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
        \App\Models\User::factory()->create([
            'name' => 'dat' ,'email' => 'dat@example.com','password' => Hash::make('admin123456'),'phone' => '12456','role_id' => '4','gender' => 'male',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'dat1' ,'email' => 'test1@example.com','password' => Hash::make('admin123456'),'phone' => '12410','role_id' => '4','gender' => 'male',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'dat2' ,'email' => 'test2@example.com','password' => Hash::make('admin123456'),'phone' => '110561','role_id' => '4','gender' => 'male',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'dat3' ,'email' => 'test3@example.com','password' => Hash::make('admin123456'),'phone' => '1242061','role_id' => '4','gender' => 'male',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'dat4' ,'email' => 'test4@example.com','password' => Hash::make('admin123456'),'phone' => '1219561','role_id' => '4','gender' => 'male',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'dat5' ,'email' => 'test5@example.com','password' => Hash::make('admin123456'),'phone' => '1243261','role_id' => '4','gender' => 'male',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'dat6' ,'email' => 'test6@example.com','password' => Hash::make('admin123456'),'phone' => '1210161','role_id' => '4','gender' => 'male',
        ]);
        $user = User::find(1);
        $userIdsToAssign = [2, 3, 4, 5, 6];
        foreach ($userIdsToAssign as $keyUser=>$valueUser) {
            $userCustomer =  User::find($valueUser);
            $userCustomer->assignRole('User');
        }
        if ($user) {
            $user->assignRole('Admin');
        }
    }
}
