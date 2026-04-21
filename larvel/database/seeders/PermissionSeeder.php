<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array of permissions to be created
        $permissions = [
            'project' => [
                'list project',
                'create project',
                'edit project',
                'delete project',
            ],
            'searching' => [
                'search',
                'filter',
                'date filter',
            ],
        ];

        // Loop through the permissions array and create each permission
        foreach ($permissions as $group => $groupPermissions) {
            foreach ($groupPermissions as $permission) {
                Permission::create(['name' => $permission, 'group_name' => $group]);
            }
        }
    }
}
