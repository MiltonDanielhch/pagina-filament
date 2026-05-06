<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/blog', [PostController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/category/{slug}', [PostController::class, 'category'])->name('posts.category');
Route::get('/contacto', [ContactController::class, 'show'])->name('contact');
Route::post('/contacto', [ContactController::class, 'send'])->name('contact.send');
Route::get('/buscar', [SearchController::class, 'index'])->name('search');
Route::get('/api/buscar', [SearchController::class, 'search']);
Route::get('/{slug}', [PageController::class, 'show'])->name('pages.show');
