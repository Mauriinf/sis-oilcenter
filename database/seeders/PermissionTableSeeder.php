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
        $permissions = [
           'lista-roles',
           'crear-roles',
           'editar-roles',
           'eliminar-roles',
           'lista-usuarios',
           'crear-usuarios',
           'editar-usuarios',
           'eliminar-usuarios'
        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
        //php artisan db:seed --class=PermissionTableSeeder
        //php artisan db:seed --class=CreateAdminUserSeeder
    }
}
