<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;

// Ruta de tipo resource
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;

// Protejer rutas usando middleware can
Route::get('', [HomeController::class, 'index'])->middleware('can:admin.home')->name('admin.home');

// Para indicar solo que cree rutas especificas usamos only
Route::resource('users', UserController::class)->only(['index', 'edit', 'update'])->names('admin.users');

Route::resource('roles', RoleController::class)->names('admin.roles');

// except para indicar que ruta queremos que no se generen
Route::resource('categories', CategoryController::class)->except('show')->names('admin.categories');
Route::resource('tags', TagController::class)->except('show')->names('admin.tags');
Route::resource('posts', PostController::class)->except('show')->names('admin.posts');
