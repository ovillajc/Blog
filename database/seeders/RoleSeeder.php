<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Spatie modelo de roles
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear los roles necesarios
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Blogger']);
        $role3 = Role::create(['name' => 'Viewer']);

        // Permisos necesarios para ver, crear, editar y eliminar
        // Permiso para ver dashboard de admin
        Permission::create(['name' => 'admin.home',
                        'description' => 'Ver el dashboard'])->syncRoles([$role1, $role2]);

        // Permisos de usuarios
        Permission::create(['name' => 'admin.users.index',
                        'description' => 'Ver listado de usuarios'])->assignRole($role1);
        Permission::create(['name' => 'admin.users.create',
                        'description' => 'Registrar un usuario'])->assignRole($role1);
        Permission::create(['name' => 'admin.users.edit',
                        'description' => 'Editar usuario'])->assignRole($role1);
        Permission::create(['name' => 'admin.users.destroy',
                        'description' => 'Eliminar usuario'])->assignRole($role1);

        // Permisos de categorias
        // Ver categoria
        Permission::create(['name' => 'admin.categories.index',
                        'description' => 'Ver listado de categorias'])->assignRole($role1);
        // Crear categoria
        Permission::create(['name' => 'admin.categories.create',
                        'description' => 'Crear categorias'])->assignRole($role1);
        // Editar categoria
        Permission::create(['name' => 'admin.categories.edit',
                        'description' => 'Editar categorias'])->assignRole($role1);
        // Eliminar categoria
        Permission::create(['name' => 'admin.categories.destroy',
                        'description' => 'Eliminar categorias'])->assignRole($role1);

        // Permisos de tags
        Permission::create(['name' => 'admin.tags.index',
                        'description' => 'Ver listado de etiquetas'])->assignRole($role1);
        Permission::create(['name' => 'admin.tags.create',
                        'description' => 'Crear etiquetas'])->assignRole($role1);
        Permission::create(['name' => 'admin.tags.edit',
                        'description' => 'Editar etiquetas'])->assignRole($role1);
        Permission::create(['name' => 'admin.tags.destroy',
                        'description' => 'Eliminar etiquetas'])->assignRole($role1);

        // Permisos de post
        Permission::create(['name' => 'admin.posts.index',
                        'description' => 'Ver listado de post'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.posts.create',
                        'description' => 'Crear post'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.edit',
                        'description' => 'Editar post'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.destroy',
                        'description' => 'Eliminar post'])->assignRole($role1);

    }
}
