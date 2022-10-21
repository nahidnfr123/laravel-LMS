<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::defaultPermissions();

        foreach ($permissions as $perms) {
            Permission::create(['name' => $perms]);
        }

        $roles = [
            'admin',
            'teacher',
            'student',
        ];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        $admin = Role::findByName('admin');

        foreach (\Spatie\Permission\Models\Permission::all() as $permission) {
            $admin->givePermissionTo($permission->name);
        }
    }
}
