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

           

        ];

        foreach ($permisos as $permiso) {
            Permission::create($permiso);
        }


        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'cliente','guard_name' => 'sanctum']);
        $role1->givePermissionTo('consultar-modulos');

        $role2 = Role::create(['name' => 'admin','guard_name' => 'sanctum']);
        $role2->givePermissionTo(Permission::all());

        
        $role3 = Role::create(['name' => 'Super-Admin','guard_name' => 'sanctum']);
        $role3->givePermissionTo(Permission::all());

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'AvanZF',
            'email' => 'test@example.com',
            'password'=> Hash::make('avanzf01')
        ]);
        // $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'AvanZF Admin',
            'email' => 'admin@example.com',
            'password'=> Hash::make('avanzf02')
        ]);
        // $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'AvanZF Super-Admin',
            'email' => 'superadmin@example.com',
            'password'=> Hash::make('avanzf03')
        ]);
        // $user->assignRole($role3);
    }
}