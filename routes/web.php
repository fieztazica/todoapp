<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
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
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::prefix('notes')->group(function () {
        Route::get('/', [NoteController::class, 'index'])->name('notes');
        Route::get('/create', [NoteController::class, 'create'])->name('notes.create');
        Route::post('/create', [NoteController::class, 'store'])->name('notes.store');
        Route::get('/{id}', [NoteController::class, 'show'])->name('notes.show');
        Route::patch('/{id}', [NoteController::class, 'update'])->name('notes.update');
        Route::delete('/{id}', [NoteController::class, 'destroy'])->name('notes.destroy');
    });

    Route::prefix('tasks')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('tasks');
        Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
        Route::post('/create', [TaskController::class, 'store'])->name('tasks.store');
        Route::get('/{id}', [TaskController::class, 'edit'])->name('tasks.edit');
        Route::patch('/{id}', [TaskController::class, 'update'])->name('tasks.update');
        Route::delete('/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    });
});

require __DIR__ . '/auth.php';
