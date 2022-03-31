<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class userSeed extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

       // create permissions
       Permission::create(['name' => 'edit articles']);
       Permission::create(['name' => 'delete articles']);
       Permission::create(['name' => 'publish articles']);
       Permission::create(['name' => 'unpublish articles']);

       // create roles and assign existing permissions
       $role1 = Role::create(['name' => 'User']);

       $role2 = Role::create(['name' => 'News Editor']);
       $role2->givePermissionTo('edit articles');
       $role2->givePermissionTo('delete articles');

        $role3 = Role::create(['name' => 'Admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Example User',
            'email' => 'test@example.com',
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example writer User',
            'email' => 'writer@example.com',
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Super-Admin User',
            'email' => 'superadmin@example.com',
        ]);
        $user->assignRole($role3);
    }
}
