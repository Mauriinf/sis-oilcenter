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
        $user = User::create([
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
        $user = User::create([
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
        $user = User::create([
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


        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}
