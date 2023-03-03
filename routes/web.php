<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(PostController::class)->group(function() {
    Route::get('/', 'index')->name('posts.index');
    Route::get('posts/{post}', 'show')->name('post.show');
    Route::get('category/{category}', 'category')->name('post.category');
    Route::get('tag/{tag}', 'tag')->name('post.tag');
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
