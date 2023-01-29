<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::post('/events/all', [App\Http\Controllers\EventsController::class, 'all'])->name('EventsAll');
Route::post('/events/set' , [App\Http\Controllers\EventsController::class, 'set'])->name('EventsSet');
Route::post('/events/delete' , [App\Http\Controllers\EventsController::class, 'delete'])->name('EventsDelete');

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
