<?php

use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SeriesController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('/series ');
});

Route::get('/function', function () {
    echo "This is a web page for your base function";
});

Route::resource('/series', SeriesController::class);
Route::resource('/series/{series}/seasons', SeasonsController::class);
Route::resource('/seasons/{season}/episodes', EpisodesController::class)->except('update');
Route::put('/seasons/{season}/episodes/', [EpisodesController::class, 'update'])->name('episodes.update');


# Route::post('series/destroy/{id}', [SeriesController::class, 'destroy'])->name('series.destroy');

//Route::controller(SeriesController::class)->group(function () {
//    Route::get('/series', 'index');
//    Route::get('/series/criar', 'create');
//    Route::post('/series/salvar', 'store');
//    Route::get('/series/{id}', 'show');
//});
