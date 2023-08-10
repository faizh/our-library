<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\BookTypesController;
use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/books', [BooksController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BooksController::class, 'create'])->name('books.add');

    Route::get('/book-types', [BookTypesController::class, 'index'])->name('book-types.index');
    Route::get('/book-types/create', [BookTypesController::class, 'create'])->name('book-types.add');
    Route::post('/book-types', [BookTypesController::class, 'store'])->name('book-types.store');
    Route::get('/book-types/edit/{id}', [BookTypesController::class, 'edit'])->name('book-types.edit');
    Route::post('/book-types/{id}', [BookTypesController::class, 'update'])->name('book-types.update');
    Route::get('/book-types/delete/{id}', [BookTypesController::class, 'destroy'])->name('book-types.delete');
});

require __DIR__.'/auth.php';
