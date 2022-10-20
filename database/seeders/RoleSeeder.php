<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'admin',
            'teacher',
            'student',
        ];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
        $permissions = [
            "view dashboard",
            "view dashboard",
        ];

        Role::where('name', 'admin')->first()->syncPermissions(Permission::all());
    }
}
