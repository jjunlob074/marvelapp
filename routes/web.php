<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonajeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ComicsController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\CreatorController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\StoriesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/personajes', [PersonajeController::class, 'index'])->name('personajes.index');


Route::get('/comics', [ComicsController::class, 'index'])->name('comics.index');
Route::get('/comics/{id}', [ComicsController::class, 'show'])->name('comics.show');
Route::get('/eventos', [EventoController::class, 'index'])->name('eventos.index');

Route::get('/fetch-creadores', [CreatorController::class, 'fetchAndStoreCreators']);
Route::get('/creadores', [CreatorController::class, 'index'])->name('creators.index');
Route::match(['post', 'delete'], '/creadores/{creator}/like', [CreatorController::class, 'toggleLike'])->name('like.toggle');
Route::get('/creadores/liked', [CreatorController::class, 'indexLiked'])->name('creators.liked');

Route::get('/series', [SeriesController::class, 'index'])->name('series.index');
Route::get('/series/{id}', [SeriesController::class, 'show'])->name('series.show');

// Ruta para mostrar el listado de historias
Route::get('/historias', [StoriesController::class, 'index'])->name('stories.index');

Route::get('/tributo', function () {
    return view('tributo.index');
})->name('tributo.index');
Route::get('/destacados', function () {
    return view('destacados.index');
})->name('destacados.index');
