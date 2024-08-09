<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'home'])->middleware('auth');
Route::get('about', [UserController::class, 'about'])->middleware('auth');
Route::get('contact', [UserController::class, 'contact']);

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class,'loginUser']);
Route::get('register', [AuthController::class, 'register']);
Route::post('register',[AuthController::class, 'registerUser']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


// Rute untuk buku
Route::middleware('auth')->group(function () {
    Route::resource('books', BookController::class);
    Route::get('mybook', [BookController::class, 'myBook'])->name('mybook');
});

// Rute untuk kategori buku
Route::middleware('auth')->group(function () {
    Route::resource('categories', BookCategoryController::class);
});