<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VakController;

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
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [AgendaController::class, 'dashboard'])->name('dashboard');

    Route::middleware('admin.only')->group(function () {
        Route::resource("/vak", VakController::class);
        Route::get('/vak/edit/{id}', [VakController::class, 'edit'])->name('vak.edit');

        Route::post('/agenda/store', [AgendaController::class, 'storeEvent'])->name('storeEvent');
        Route::get('/planning', [AgendaController::class, 'index'])->name('planning.index');
        
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
