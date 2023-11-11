<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;

class PermissionsSeeder extends Seeder
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

        $permisos = [
            //Modulos
            ['name' => 'crear-modulos', 'guard_name' => 'sanctum'],
            ['name' => 'editar-modulos', 'guard_name' => 'sanctum'],
            ['name' => 'borrar-modulos', 'guard_name' => 'sanctum'],
            ['name' => 'consultar-modulos', 'guard_name' => 'sanctum'],

            //Organizacion
            ['name' => 'crear-organizacion', 'guard_name' => 'sanctum'],
            ['name' => 'editar-organizacion', 'guard_name' => 'sanctum'],
            ['name' => 'borrar-organizacion', 'guard_name' => 'sanctum'],
            ['name' => 'consultar-organizacion', 'guard_name' => 'sanctum'],

            //Documentos Firmas
            ['name' => 'crear-doctFirm', 'guard_name' => 'sanctum'],
            ['name' => 'editar-doctFirm', 'guard_name' => 'sanctum'],
            ['name' => 'borrar-doctFirm', 'guard_name' => 'sanctum'],
            ['name' => 'consultar-doctFirm', 'guard_name' => 'sanctum'],

            //User
            ['name' => 'crear-user', 'guard_name' => 'sanctum'],
            ['name' => 'editar-user', 'guard_name' => 'sanctum'],
            ['name' => 'borrar-user', 'guard_name' => 'sanctum'],
            ['name' => 'consultar-user', 'guard_name' => 'sanctum'],

            //Log Firmas
            ['name' => 'crear-logFirmas', 'guard_name' => 'sanctum'],
            ['name' => 'editar-logFirmas', 'guard_name' => 'sanctum'],
            ['name' => 'borrar-logFirmas', 'guard_name' => 'sanctum'],
            ['name' => 'consultar-logFirmas', 'guard_name' => 'sanctum'],
        ];

        foreach ($permisos as $permiso) {
            Permission::create($permiso);
        }


        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'cliente','guard_name' => 'sanctum']);
        $role1->givePermissionTo('consultar-modulos');

        $role2 = Role::create(['name' => 'AvanZF','guard_name' => 'sanctum']);
        $role2->givePermissionTo(Permission::all());

        
        $role3 = Role::create(['name' => 'Super-Admin','guard_name' => 'sanctum']);
        $role3->givePermissionTo(Permission::all());

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Cliente',
            'email' => 'test@avanzf.cl',
            'password'=> Hash::make('avanzf01')
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'AvanZF Admin',
            'email' => 'admin@avanzf.cl',
            'password'=> Hash::make('avanzf02')
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'AvanZF Super-Admin',
            'email' => 'superadmin@avanzf.cl',
            'password'=> Hash::make('avanzf03')
        ]);
        $user->assignRole($role3);
    }
}