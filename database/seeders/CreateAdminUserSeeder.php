<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username' => 'mnina',
            'email' => 'dnina826@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
            'direccion' => '',
            'telefono' => '',
            'ci' => '8537800',
            'nombres' => 'MAURICIO',
            'paterno' => 'NINA',
            'materno' => 'CANAVIRI',
            'fec_nac' => '1995-01-01',
            'estado' => '1',
            'sexo' => 'M'
        ]);
        $proveedor = User::create([
            'username' => 'mflores',
            'email' => 'maria@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
            'direccion' => 'Florida',
            'telefono' => '75555555',
            'ci' => '8888888',
            'nombres' => 'MARIA',
            'paterno' => 'FLORES',
            'materno' => 'MAMANI',
            'fec_nac' => '1995-01-01',
            'estado' => '1',
            'sexo' => 'F'
        ]);
        $vendedor = User::create([
            'username' => 'vpepe',
            'email' => 'pepe@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
            'direccion' => 'CAÑETE',
            'telefono' => '77777777',
            'ci' => '555555',
            'nombres' => 'PEPE',
            'paterno' => 'VELASQUEZ',
            'materno' => 'PERALES',
            'fec_nac' => '1995-01-20',
            'estado' => '1',
            'sexo' => 'M'
        ]);
        $mecanico = User::create([
            'username' => 'andres',
            'email' => 'andres@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
            'direccion' => 'BANDERAS',
            'telefono' => '78888888',
            'ci' => '444444',
            'nombres' => 'ANDRES',
            'paterno' => 'MAMANI',
            'materno' => 'LAIME',
            'fec_nac' => '1995-01-10',
            'estado' => '1',
            'sexo' => 'M'
        ]);
        $cliente = User::create([
            'username' => 'juancito',
            'email' => 'juan@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
            'direccion' => 'Universitaria',
            'telefono' => '6484155',
            'ci' => '121548',
            'nombres' => 'JUANCITO',
            'paterno' => 'PINTO',
            'materno' => '',
            'fec_nac' => '1995-01-10',
            'estado' => '1',
            'sexo' => 'M'
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        //crear roles y asignar permisos
        Role::create(['name' => 'Vendedor']);
        Role::create(['name' => 'Cliente']);
        Role::create(['name' => 'Mecanico']);
        Role::create(['name' => 'Proveedor']);
        $vendedorRole = Role::where('name', 'Vendedor')->first();
        $clienteRole = Role::where('name', 'Cliente')->first();
        $mecanicoRole = Role::where('name', 'Mecanico')->first();
        $proveedorRole = Role::where('name', 'Proveedor')->first();

        $vendedorPermissions = [
            'lista-ingresos',
            'registrar-ingresos',
            'ver-ingresos',
            'eliminar-ingresos',
            'cancelar-saldo-ingreso',
            'lista-ventas',
            'registrar-ventas',
            'ver-detalle-ventas',
            'eliminar -ventas',
            'cancelar-saldo-ventas',
            'lista-servicios',
            'lista-publicaciones',
            'lista-usuarios',
            'editar-usuarios',
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
        ];

        $clientePermissions = [
            'lista-ventas',
            'ver-detalle-ventas',
            'lista-servicios',
            'ver-detalle-servicio',
        ];
        $mecanicoPermissions = [
            'lista-usuarios',
            'crear-usuarios',
            'editar-usuarios',
            'eliminar-usuarios',
            'lista-articulos',
            'lista-ventas',
            'ver-detalle-ventas',
            'lista-servicios',
            'registrar-servicios',
            'ver-detalle-servicio',
            'eliminar-servicio',
        ];
        $proveedorPermissions = [
            'lista-articulos',
            'lista-ingresos',
            'ver-ingresos',
            'lista-categorias',
        ];
        foreach ($vendedorPermissions as $permission) {
            $vendedorRole->permissions()->attach(Permission::where('name', $permission)->first());
        }

        foreach ($clientePermissions as $permission) {
            $clienteRole->permissions()->attach(Permission::where('name', $permission)->first());
        }
        foreach ($mecanicoPermissions as $permission) {
            $mecanicoRole->permissions()->attach(Permission::where('name', $permission)->first());
        }
        foreach ($proveedorPermissions as $permission) {
            $proveedorRole->permissions()->attach(Permission::where('name', $permission)->first());
        }
        $vendedor->assignRole('Vendedor'); // Asigna el rol de vendedor al usuario
        $cliente->assignRole('Cliente'); // Asigna el rol de cliente al usuario
        $proveedor->assignRole('Proveedor'); // Asigna el rol de proveedor al usuario
        $mecanico->assignRole('Mecanico'); // Asigna el rol de mecanico al usuario
    }
}
