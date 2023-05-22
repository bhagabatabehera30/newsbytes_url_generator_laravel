<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\HomeController;

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
    return view('home');
});

Route::get('/home', [HomeController::class, 'index'])->name('home.index');
//Route::get('test', [HomeController::class, 'test']);
Route::get('/{hash}', [HomeController::class, 'redirect']);

