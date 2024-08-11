<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('categories.index');
        Route::get('/categories/create', 'create')->name('categories.create');
        Route::post('/categories', 'store')->name('categories.store');
        Route::get('/categories/{id}', 'view')->name('categories.view');
        Route::get('/categories/{id}/edit', 'edit')->name('categories.edit');
        Route::put('/categories/{id}', 'update')->name('categories.update');
        Route::delete('/categories/{id}', 'destroy')->name('categories.destroy');
    });

    Route::controller(BookController::class)->group(function () {
        Route::get('/books/excel', 'exportExcel')->name('books.export-excel');
        Route::get('/books/pdf', 'exportPdf')->name('books.export-pdf');
        Route::get('/books', 'index')->name('books.index');
        Route::get('/books/create', 'create')->name('books.create');
        Route::post('/books', 'store')->name('books.store');
        Route::get('/books/{id}', 'view')->name('books.view');
        Route::get('/books/{id}/edit', 'edit')->name('books.edit');
        Route::put('/books/{id}', 'update')->name('books.update');
        Route::delete('/books/{id}', 'destroy')->name('books.destroy');
    });
});

require __DIR__ . '/auth.php';
