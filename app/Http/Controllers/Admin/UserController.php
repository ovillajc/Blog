<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        // Protejer a todas las rutas de admin
        // $this->middleware('can:admin.users.index');
        // Especificar que solo proteja al metodo index
        $this->middleware('can:admin.users.index')->only('index');
        $this->middleware('can:admin.users.edit')->only('edit'. 'update');
    }

    public function index()
    {
        $users = User::paginate(5);
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();


        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        // Registrar el registro de usuario en la tabla model_has_roles
        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.edit', $user)->with('info', 'Roles asignados correctamente');
    }

}
