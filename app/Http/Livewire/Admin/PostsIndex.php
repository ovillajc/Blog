<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Post;

class PostsIndex extends Component
{
    // usando la paginación
    use WithPagination;

    // Para quitar la paginacion de tailwind
    protected $paginationTheme = "bootstrap";

    // barra de busqueda
    public $search;

    // Resetear el buscador a pagina uno
    public function updatingSearch() {
        $this->resetPage();
    }


    public function render()
    {
        /* Indicar que necesitamos saber que usuario esta auntentificado para tomar su id y usarlo
        para traer todos los post que tengan su id */
        $posts = Post::where('user_id', auth()->user()->id)
                        ->where('name', 'LIKE','%' . $this->search . '%')
                        ->latest('id')
                        ->paginate();

        return view('livewire.admin.posts-index', compact('posts'));
    }
}
