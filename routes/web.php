<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

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
    return view('movies.search');
});

Route::name('movies.')->group(function () {
    Route::get('/search', [MovieController::class, 'search'])->name('movie-search');
    Route::get('/details/{id}', [MovieController::class, 'details'])->name('movie-details');
    Route::get('/trending', [MovieController::class, 'trending'])->name('trending-movies');
});

