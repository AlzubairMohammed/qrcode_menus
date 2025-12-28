<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Roles
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $owner = Role::firstOrCreate(['name' => 'owner', 'guard_name' => 'web']);
        $driver = Role::firstOrCreate(['name' => 'driver', 'guard_name' => 'web']);
        $client = Role::firstOrCreate(['name' => 'client', 'guard_name' => 'web']);
        $staff = Role::firstOrCreate(['name' => 'staff', 'guard_name' => 'web']);

        //Permissions
        $admin->givePermissionTo(Permission::firstOrCreate(['name' => 'manage restorants', 'guard_name' => 'web']));
        $admin->givePermissionTo(Permission::firstOrCreate(['name' => 'manage drivers', 'guard_name' => 'web']));
        $admin->givePermissionTo(Permission::firstOrCreate(['name' => 'manage orders', 'guard_name' => 'web']));
        $admin->givePermissionTo(Permission::firstOrCreate(['name' => 'edit settings', 'guard_name' => 'web']));

        $owner->givePermissionTo(Permission::firstOrCreate(['name' => 'view orders', 'guard_name' => 'web']));
        $owner->givePermissionTo(Permission::firstOrCreate(['name' => 'edit restorant', 'guard_name' => 'web']));

        $driver->givePermissionTo(Permission::firstOrCreate(['name' => 'edit orders', 'guard_name' => 'web']));

        $backedn = Permission::firstOrCreate(['name' => 'access backedn', 'guard_name' => 'web']);
        $admin->givePermissionTo($backedn);
        $owner->givePermissionTo($backedn);
        $driver->givePermissionTo($backedn);

        //ADD ADMIN USER ROLE
        $user = \App\User::find(1);
        if ($user && ! $user->hasRole('admin')) {
            $user->assignRole('admin');
        }
    }
}
