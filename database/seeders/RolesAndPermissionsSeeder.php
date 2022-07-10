<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    private $permissions = [
        'manage referee',
        'manage coach',
        'manage athlete',
        'manage tournament'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        foreach ($this->permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission]);
        }

        // create roles and assign created permissions
        Role::create(['name' => 'admin'])
            ->givePermissionTo(Permission::all());

        Role::create(['name' => 'coach'])
            ->givePermissionTo(['manage athlete', 'manage coach']);
    }
}

