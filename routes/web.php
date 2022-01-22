<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('about', [PageController::class, 'about']);

Route::get('articles', [ArticleController::class, 'index'])
    ->name('articles.index');

Route::get('articles/create', [ArticleController::class, 'create'])
    ->name('articles.create');

// POST-запрос (т.к. сохранение(запись) в БД - ? )
Route::post('articles', [ArticleController::class, 'store'])
    ->name('articles.store');

Route::get('articles/{id}/edit', [ArticleController::class, 'edit'])
    ->name('articles.edit');

Route::get('articles/{id}', [ArticleController::class, 'show'])
    ->name('articles.show');

// Метод PATCH
Route::patch('articles/{id}', [ArticleController::class, 'update'])
    ->name('articles.update');
