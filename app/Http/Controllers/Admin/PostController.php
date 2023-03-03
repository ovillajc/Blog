<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

// Guardar imagenes en el proyecto
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.posts.index')->only('index');
        $this->middleware('can:admin.posts.create')->only('create');
        $this->middleware('can:admin.posts.edit')->only('edit', 'update');
        $this->middleware('can:admin.posts.destroy')->only('destroy');
    }

    public function index()
    {
        return view('admin.posts.index');
    }

    public function create()
    {
        // Recuperar las categorias para mostrarlas en un dropdawn
        $categories = Category::pluck('name', 'id'); // pluck genera un array en este caso de name
        //Recuperar las etiquetas
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(PostRequest $request)
    {
        // La reglas de validacion las toma de StorePostRequest
        $post = Post::create($request->all());

        if($request->file('file')) {
            // Mover imagenes a la carpeta storage
            $url = Storage::put('public/posts', $request->file('file'));

            // Agregar registro a la tabla image y relacionarlo a la tabla post
            $post->image()->create([
                'url' => $url
            ]);
        }

        if($request->tags) {
            // Guardar las etiquetas seleccionadas con attach
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('admin.posts.edit', $post);
    }

    public function edit(Post $post)
    {
        $this->authorize('author', $post);

        // Recuperar las categorias para mostrarlas en un dropdawn
        $categories = Category::pluck('name', 'id'); // pluck genera un array en este caso de name
        //Recuperar las etiquetas
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(PostRequest $request, Post $post)
    {
        // Regla de autorizacion desde PostPolicy
        $this->authorize('author', $post);

        $post->update($request->all());

        // Preguntamos si hay una imagen ya en la base de datos
        if($request->file('file')) {
            $url = Storage::put('public/posts', $request->file('file'));

            // Preguntamos si el usuario esta añadiendo una nueva imagen
            if($post->image) {
                // Borramos la imagen antigua
                Storage::delete($post->image->url);

                // Guardamos la nueva imagen
                $post->image->update([
                    'url' => $url
                ]);
            } else {
                // En el caso de que no haya imagen en la bd creamos un nuevo registro en la tabla image
                $post->image()->create([
                    'url' => $url
                ]);
            }
        }

        if($request->tags) {
            // Guardar las etiquetas seleccionadas con sync para que no duplique los registros
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('admin.posts.edit', $post)->with('info', 'Post actualizado exitosamente');
    }

    public function destroy(Post $post)
    {
        // Regla de autorizacion desde PostPolicy
        $this->authorize('author', $post);

        // Eliminar el post seleccionado
        $post->delete();

        return redirect()->route('admin.posts.index')->with('info', 'Post eliminado exitosamente');
    }
}
