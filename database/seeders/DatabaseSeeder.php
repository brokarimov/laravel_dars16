<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;
use Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create two users
        $user1 = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make(12345678),
        ]);

        $user2 = User::factory()->create([
            'name' => 'User1',
            'email' => 'user1@gmail.com',
            'password' => Hash::make(12345678),
        ]);
        $user3 = User::factory()->create([
            'name' => 'user2',
            'email' => 'user2@gmail.com',
            'password' => Hash::make(12345678),
        ]);
        $user4 = User::factory()->create([
            'name' => 'user3',
            'email' => 'user3@gmail.com',
            'password' => Hash::make(12345678),
        ]);
        $user5 = User::factory()->create([
            'name' => 'use4',
            'email' => 'user4@gmail.com',
            'password' => Hash::make(12345678),
        ]);
        $user6 = User::factory()->create([
            'name' => 'user5',
            'email' => 'user5@gmail.com',
            'password' => Hash::make(12345678),
        ]);

        // Create roles
        $role1 = Role::create([
            'name' => 'admin'
        ]);
        $role2 = Role::create([
            'name' => 'user'
        ]);
        $role3 = Role::create([
            'name' => 'create'
        ]);
        $role4 = Role::create([
            'name' => 'show'
        ]);
        $role5 = Role::create([
            'name' => 'update'
        ]);
        $role6 = Role::create([
            'name' => 'destroy'
        ]);

        $routes = Route::getRoutes();
        foreach ($routes as $route) {
            $key = $route->getName();

            if ($key && !str_starts_with($key, 'generated::') && $key !== 'storage.local') {
                $permission = Permission::create([
                    'name' => $key,
                ]);
                $role1->givePermissionTo($permission);
                if ($key == 'students') {
                    $role2->givePermissionTo($permission);
                }
                if ($key =='students' || $key == 'students.create' || $key =='students.store') {
                    $role3->givePermissionTo($permission);
                }
                if ($key =='students' || $key == 'students.show') {
                    $role4->givePermissionTo($permission);
                }
                if ($key =='students' || $key == 'students.edit' || $key == 'students.update') {
                    $role5->givePermissionTo($permission);
                }
                if ($key =='students' || $key == 'students.destroy') {
                    $role6->givePermissionTo($permission);
                }
            }
        }

        $user1->assignRole($role1);
        $user2->assignRole($role2);
        $user3->assignRole($role3);
        $user4->assignRole($role4);
        $user5->assignRole($role5);
        $user6->assignRole($role6);
        


    }
}
