<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Otra forma de habilitar la asiganción masiva
    // Dentro del array van los campos que queremos evitar que se llenen por asiganacion masiva
    protected $guarded = ['id', 'create_at', 'update_at'];

    // Relacion uno a mucho inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relacion mucho a muchos post/etiquetas
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    // Relacion uno a uno POLIMORFICA
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
