<?php

namespace App\Observers;

use Illuminate\Support\Facades\Storage;

use App\Models\Post;

class PostObserver
{
    public function creating(Post $post)
    {
        // Para que no de problemas al ejecutar los seeders
        if (! \App::runningInConsole()) {
            $post->user_id = auth()->user()->id;
        }
    }

    public function deleted(Post $post)
    {
        // Verificamos si existe alguna imagen asociada al post para tambien eliminar ese registro
        if($post->image) {
            Storage::delete($post->image->url);
        }
    }
}
