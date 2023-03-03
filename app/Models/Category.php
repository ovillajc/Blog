<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Asignacion masiva
    protected $fillable = ['name', 'slug'];

    // Para que laravel tome el slug en la url y no el id
    public function getRouteKeyName()
    {
        return "slug";
    }

    public function post()
    {
        // Relacion uno a muchos
        return $this->hasMany(Post::class);

    }
}
