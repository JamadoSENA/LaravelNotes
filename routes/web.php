<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

//PPAL
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/all', [HomeController::class, 'all'])->name('home.all');

//Articulos
Route::resource('articles', ArticleController::class)
                ->except('show')
                ->names('articles');

//Categorias
Route::resource('categories', CategoryController::class)
                ->except('show')
                ->names('categories');

//Comentarios
Route::resource('comments', CommentController::class)
->only('index','destroy')
->names('comments');

//Perfiles
Route::resource('profiles', ProfileController::class)
->only('edit', 'update')
->names('profiles');

//Ver Articulos                
Route::get('article/{article}', [ArticleController::class, 'show'])->name('articles.show');

//Filtrar Articulos por Categorias
Route::get('category/{category}', [CategoryController::class, 'detail'])->name('categories.detail');

Route::get('/comment', [CommentController::class, 'store'])->name('comments.store');

Auth::routes();