<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'page-list', 'guard_name' => 'web']);
        Permission::create(['name' => 'page-create', 'guard_name' => 'web']);
        Permission::create(['name' => 'page-edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'page-delete', 'guard_name' => 'web']);

        Permission::create(['name' => 'advertisement-list', 'guard_name' => 'web']);
        Permission::create(['name' => 'advertisement-create', 'guard_name' => 'web']);
        Permission::create(['name' => 'advertisement-edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'advertisement-delete', 'guard_name' => 'web']);

        Permission::create(['name' => 'auction-list', 'guard_name' => 'web']);
        Permission::create(['name' => 'auction-create', 'guard_name' => 'web']);
        Permission::create(['name' => 'auction-edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'auction-delete', 'guard_name' => 'web']);

        Permission::create(['name' => 'category-list', 'guard_name' => 'web']);
        Permission::create(['name' => 'category-create', 'guard_name' => 'web']);
        Permission::create(['name' => 'category-edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'category-delete', 'guard_name' => 'web']);

        Permission::create(['name' => 'region-list', 'guard_name' => 'web']);
        Permission::create(['name' => 'region-create', 'guard_name' => 'web']);
        Permission::create(['name' => 'region-edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'region-delete', 'guard_name' => 'web']);

        Permission::create(['name' => 'slide-list', 'guard_name' => 'web']);
        Permission::create(['name' => 'slide-create', 'guard_name' => 'web']);
        Permission::create(['name' => 'slide-edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'slide-delete', 'guard_name' => 'web']);

        Permission::create(['name' => 'menu-list', 'guard_name' => 'web']);
        Permission::create(['name' => 'menu-create', 'guard_name' => 'web']);
        Permission::create(['name' => 'menu-edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'menu-delete', 'guard_name' => 'web']);

        Permission::create(['name' => 'role-list', 'guard_name' => 'web']);
        Permission::create(['name' => 'role-create', 'guard_name' => 'web']);
        Permission::create(['name' => 'role-edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'role-delete', 'guard_name' => 'web']);

        Permission::create(['name' => 'permission-list', 'guard_name' => 'web']);
        Permission::create(['name' => 'permission-create', 'guard_name' => 'web']);
        Permission::create(['name' => 'permission-edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'permission-delete', 'guard_name' => 'web']);

        Permission::create(['name' => 'user-list', 'guard_name' => 'web']);
        Permission::create(['name' => 'user-create', 'guard_name' => 'web']);
        Permission::create(['name' => 'user-edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'user-delete', 'guard_name' => 'web']);

    }
}
