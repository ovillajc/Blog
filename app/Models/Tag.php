<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    // Activar la asignacion masiva para poder guardar datos en la tabla tags
    protected $fillable = ['name', 'slug', 'color'];

    // Para que en la url aparezca el nombre de la etiqueta en vez del id
    public function getRouteKeyName()
    {
        return "slug";
    }

    // Relacion mucho a muchos post/etiquetas
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
