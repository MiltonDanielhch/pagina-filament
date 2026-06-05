<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\OfficialController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;

// Filament routes (auto-registered by Filament)
// Livewire routes are automatically registered by Livewire v3

Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/blog', [PostController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/category/{slug}', [PostController::class, 'category'])->name('posts.category');
Route::get('/eventos', [EventController::class, 'index'])->name('events');
Route::get('/galeria', [GalleryController::class, 'index'])->name('gallery');
Route::get('/galeria/{slug}', [GalleryController::class, 'show'])->name('gallery.show');
Route::get('/resultados', [AchievementController::class, 'index'])->name('achievements');
Route::get('/autoridades', [OfficialController::class, 'index'])->name('officials');
Route::get('/contacto', [ContactController::class, 'show'])->name('contact');
Route::post('/contacto', [ContactController::class, 'send'])->name('contact.send');
Route::get('/buscar', [SearchController::class, 'index'])->name('search');
Route::get('/api/buscar', [SearchController::class, 'search']);
Route::view('/gobernador', 'gobernador')->name('gobernador');
Route::get('/{slug}', [PageController::class, 'show'])->name('pages.show');
