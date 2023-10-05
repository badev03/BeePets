<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo các quyền (permissions) cho CRUD của Service
        Permission::create(['name' => 'create-service' , 'group' => 'service']);
        Permission::create(['name' => 'read-service' , 'group' => 'service']);
        Permission::create(['name' => 'update-service' , 'group' => 'service']);
        Permission::create(['name' => 'delete-service' , 'group' => 'service']);


        Permission::create(['name' => 'create-doctors' , 'group' => 'doctors']);
        Permission::create(['name' => 'read-doctors' , 'group' => 'doctors']);
        Permission::create(['name' => 'update-doctors' , 'group' => 'doctors']);
        Permission::create(['name' => 'delete-doctors' , 'group' => 'service']);

        // Tạo các quyền (permissions) cho CRUD của Category Service
        Permission::create(['name' => 'create-category-service' , 'group' => 'category-service']);
        Permission::create(['name' => 'read-category-service' , 'group' => 'category-service']);
        Permission::create(['name' => 'update-category-service' , 'group' => 'category-service']);
        Permission::create(['name' => 'delete-category-service' , 'group' => 'category-service']);

        // Tạo các quyền (permissions) cho CRUD của Product
        Permission::create(['name' => 'create-product' , 'group' => 'product']);
        Permission::create(['name' => 'read-product' , 'group' => 'product']);
        Permission::create(['name' => 'update-product' , 'group' => 'product']);
        Permission::create(['name' => 'delete-product' , 'group' => 'product']);

        // Tạo các quyền (permissions) cho CRUD của Category Product
        Permission::create(['name' => 'create-category-product' , 'group' => 'category-product']);
        Permission::create(['name' => 'read-category-product' , 'group' => 'category-product']);
        Permission::create(['name' => 'update-category-product' , 'group' => 'category-product']);
        Permission::create(['name' => 'delete-category-product' , 'group' => 'category-product']);

        Permission::create(['name' => 'create-role' , 'group' => 'role']);
        Permission::create(['name' => 'read-role' , 'group' => 'role']);
        Permission::create(['name' => 'update-role' , 'group' => 'role']);
        Permission::create(['name' => 'delete-role' , 'group' => 'role']);

        Permission::create(['name' => 'create-permission' , 'group' => 'permission']);
        Permission::create(['name' => 'read-permission'  , 'group' => 'permission']);
        Permission::create(['name' => 'update-permission'  , 'group' => 'permission']);
        Permission::create(['name' => 'delete-permission'  , 'group' => 'permission']);

        Permission::create(['name' => 'create-PeopleAccount'  , 'group' => 'PeopleAccount']);
        Permission::create(['name' => 'read-PeopleAccount' , 'group' => 'PeopleAccount']);
        Permission::create(['name' => 'update-PeopleAccount' , 'group' => 'PeopleAccount']);
        Permission::create(['name' => 'delete-PeopleAccount' , 'group' => 'PeopleAccount']);


        Permission::create(['name' => 'create-appointment'  , 'group' => 'appointment']);
        Permission::create(['name' => 'read-appointment' , 'group' => 'appointment']);
        Permission::create(['name' => 'update-appointment' , 'group' => 'appointment']);
        Permission::create(['name' => 'delete-appointment' , 'group' => 'appointment']);



        // Tạo vai trò (roles)
        $user = \App\Models\User::find(1);

        if ($user) {
            $adminRole = Role::where('name', 'Admin')->first();
            // Gán quyền cho vai trò Admin
            $adminRole->givePermissionTo([
                'create-service', 'read-service', 'update-service', 'delete-service',
                'create-category-service', 'read-category-service', 'update-category-service', 'delete-category-service',
                'create-product', 'read-product', 'update-product', 'delete-product',
                'create-category-product', 'read-category-product', 'update-category-product', 'delete-category-product',
                'create-role', 'read-role', 'update-role', 'delete-role',
                'create-permission', 'read-permission', 'update-permission', 'delete-permission',
                'create-PeopleAccount', 'read-PeopleAccount', 'update-PeopleAccount', 'delete-PeopleAccount',

                'create-doctors','read-doctors','update-doctors','delete-doctors',
                'create-appointment','read-appointment','update-appointment',
            ]);
        }


    }
}
