<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        // Recuperar el listado de todos los roles
        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        // Recuperar el listado de permisos
        $permissions = Permission::all();

        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        // Reglas de validación
        $request->validate([
            'name' => 'required'
        ]);

        // Crear el nuevo rol
        $role = Role::create($request->all());

        // Sincronizar el rol con los permisos seleccionados
        $role->permissions()->sync($request->permissions);

        // Redireccionar a la ruda donde se edita el rol
        return redirect()->route('admin.roles.edit', $role)->with('info', 'Rol creado exitosamente');
    }

    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        // Reglas de validación
        $request->validate([
            'name' => 'required'
        ]);

        // Actualizar el rol con la información mandada desde el formulario
        $role->update($request->all());

        // Sincronizar el rol con los nuevos permisos marcados
        $role->permissions()->sync($request->permissions);

        // Redireccionar
        return redirect()->route('admin.roles.edit', $role)->with('info', 'Rol actualizado exitosamente');
    }

    public function destroy(Role $role)
    {
        // Eliminar un rol
        $role->delete();

        return redirect()->route('admin.roles.index', $role)->with('info', 'Rol eliminado exitosamente');
    }
}
