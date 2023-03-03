<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;

        // Para que el usuario no pueda modificar el id del input oculto
        // if($this->user_id == auth()->user()->id) {
        //    return true;
        // } else {
        //     return false;
        // }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // Evitar la regla de slug cuando vamos a actualizar un post
        $post = $this->route()->parameter('post');

        // Reglas de validacion para el formulario de post
        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:posts',
            'status' => 'required|in:1,2',
            'file' => 'image'
        ];

        if($post) {
            $rules['slug'] = 'required|unique:posts,slug,' . $post->id;
        }

        // En caso de que el post no sea un borrador
        if($this->status == 2) {
            $rules = array_merge($rules, [
                'category_id' => 'required',
                'tags' => 'required',
                'extract' => 'required',
                'body' => 'required'
            ]);
        }

        return $rules;
    }
}
