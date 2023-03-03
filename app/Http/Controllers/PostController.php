<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class PostController extends Controller
{
    // Mostrar los post
    public function index()
    {
        $posts = Post::where('status', 2)->latest('id')->paginate(8);

        return view('posts.index', compact('posts'));
    }
    public function show(Post $post)
    {
        // Llamamos al authorize de PostPolicy
        $this->authorize('published', $post);

        // Recuperar el registro de los post relacionados
        // Por medio de category_id, obtenemos los ultimos 4
        $similares = Post::where('category_id', $post->category_id)
                        ->where('status', 2) // Post con el status 2
                        ->where('id', '!=', $post->id) // Para evitar que aparezca el post seleccionado
                        ->latest('id') // Ultimos 4
                        ->take(4) // Pedimos 2
                        ->get();

        return view('posts.show', compact('post', 'similares'));
    }

    public function category(Category $category)
    {
        $posts = Post::where('category_id', $category->id)
                        ->where('status', 2)
                        ->latest('id')
                        ->paginate(6);

        return view('posts.category', compact('posts', 'category'));
    }

    public function tag(Tag $tag)
    {
        $posts = $tag->posts()->where('status', 2)->latest('id')->paginate(4);

        return view('posts.tag', compact('posts', 'tag'));
    }
}

