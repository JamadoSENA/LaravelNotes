<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//PPAL
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/all', [HomeController::class, 'all'])->name('home.all');

//Articulos
Route::resource('articles', ArticleController::class)
                ->names('articles');

//Categorias
Route::resource('categories', CategoryController::class)
                ->except('show')
                ->names('categories');
