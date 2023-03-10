<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;

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

Route::get('/', [BukuController::class, 'indexPublic'])->name('buku.public.index');
Route::get('/bukus/{id}', [BukuController::class, 'showPublic'])->name('buku.public.show');

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [BukuController::class, 'index'])->name('home');
    Route::resource('buku', BukuController::class);
});