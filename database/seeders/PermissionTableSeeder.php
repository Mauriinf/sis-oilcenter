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
           'registrar-usuarios',
           'editar-usuarios',
           'eliminar-usuarios',
           'lista-categorias',
            'registrar-categorias',
            'editar-categorias',
            'habilitar-inhabilitar-categorias',
            'lista-tipos-servicios',
            'crear-tipos-servicios',
            'editar-tipos-servicios',
            'lista-articulos',
            'registrar-articulos',
            'editar-articulos',
            'habilitar-inhabilitar-articulos',
            'lista-ingresos',
            'registrar-ingresos',
            'ver-ingresos',
            'eliminar-ingresos',
            'cancelar-saldo-ingreso',
            'lista-ventas',
            'registrar-ventas',
            'ver-detalle-ventas',
            'eliminar-ventas',
            'cancelar-saldo-ventas',
            'lista-servicios',
            'registrar-servicios',
            'ver-detalle-servicio',
            'eliminar-servicio',
            'lista-publicaciones',
            'registrar-publicaciones',
            'editar-publicaciones',
            'eliminar-publicaciones'

        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
        //php artisan db:seed --class=PermissionTableSeeder
        //php artisan db:seed --class=CreateAdminUserSeeder
    }
}
