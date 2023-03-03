<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;

    // para sincronizar lo que se escribe en el input con la variable
    public $search;

    // idicamos que usaremos bootstrap
    protected $paginationTheme = "bootstrap";

    // Resetear el buscador a pagina uno
    public function updatingSearch() {
        $this->resetPage();
    }

    public function render()
    {
        // Recuperamos el listado de usuarios
        $users = User::where('name', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('email', 'LIKE', '%' . $this->search . '%')->paginate();

        return view('livewire.admin.users-index', compact('users'));
    }
}
