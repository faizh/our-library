<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\BookTypesController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
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

Route::group(['middleware' => ['auth']], function() {
    Route::group(['prefix' => 'profile'], function() {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    
    Route::group(['prefix' => 'books'], function() {
        Route::get('/', [BooksController::class, 'index'])->name('books.index');
        Route::get('/create', [BooksController::class, 'create'])->name('books.add');
        Route::post('/', [BooksController::class, 'store'])->name('books.store');
        Route::get('/{id}', [BooksController::class, 'show'])->name('books.view');
        Route::get('/edit/{id}', [BooksController::class, 'edit'])->name('books.edit');
        Route::get('/delete/{id}', [BooksController::class, 'destroy'])->name('books.delete');
        Route::post('/{id}', [BooksController::class, 'update'])->name('books.update');
    });

    Route::group(['prefix' => 'carts'], function() {
        Route::get('/', [CartController::class, 'index'])->name('carts.index');
        Route::post('/add', [CartController::class, 'store'])->name('carts.add');
        Route::get('/checkout', [CartController::class, 'index'])->name('carts.checkout');
        Route::get('/delete/{id}', [CartController::class, 'destroy'])->name('carts.delete');
        Route::patch('/update', [CartController::class, 'update'])->name('carts.update'); 
    });

    Route::group(['prefix' => 'book-types'], function() {
        Route::get('/', [BookTypesController::class, 'index'])->name('book-types.index');
        Route::get('/create', [BookTypesController::class, 'create'])->name('book-types.add');
        Route::post('/', [BookTypesController::class, 'store'])->name('book-types.store');
        Route::get('/edit/{id}', [BookTypesController::class, 'edit'])->name('book-types.edit');
        Route::post('/{id}', [BookTypesController::class, 'update'])->name('book-types.update');
        Route::get('/delete/{id}', [BookTypesController::class, 'destroy'])->name('book-types.delete'); 
    });

    Route::group(['prefix' => 'transactions'], function() {
        Route::get('/', [TransactionController::class, 'index'])->name('transactions.index');
        Route::get('/detail/{id}', [TransactionController::class, 'show'])->name('transactions.view');
        Route::get('/create', [TransactionController::class, 'create'])->name('transactions.create');
        Route::post('/', [TransactionController::class, 'store'])->name('transactions.store');
        Route::post('/return/{id}', [TransactionController::class, 'return'])->name('transactions.return');
    });

    Route::group(['prefix' => 'reports'], function() {
        Route::get('/list', [ReportController::class, 'list_report'])->name('reports.list');
        Route::get('/chart', [ReportController::class, 'chart_report'])->name('reports.chart');
    });
});

require __DIR__.'/auth.php';
