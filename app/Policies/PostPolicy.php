<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    // !Los policy nos sirven para proteger nustras rutas

    public function author(User $user, Post $post) {
        if ($user->id == $post->user_id) {
            return true;
        } else {
            return false;
        }
    }

    // Verificar si el post tiene el estatus de publicado 1
    // Colocamos ? para que pudean accerder a los post sin estar logeados
    public function published(?User $user, Post $post) {
        if ($post->status == 2) {
            return true;
        } else {
            return false;
        }
    }
}
