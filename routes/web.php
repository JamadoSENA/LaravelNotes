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
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');

Route::get('/articles/{articles}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
Route::put('/articles/{articles}', [ArticleController::class, 'update'])->name('articles.update');
Route::delete('/articles/{articles}', [ArticleController::class, 'destroy'])->name('articles.delete');
