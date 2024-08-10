<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;

// Route Auth
Route::get('/', [UserController::class, 'home'])->middleware('auth');
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class,'loginUser']);
Route::get('register', [AuthController::class, 'register']);
Route::post('register',[AuthController::class, 'registerUser']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


// Route Book
Route::middleware('auth')->group(function () {
    Route::resource('books', BookController::class);
    Route::get('mybook', [BookController::class, 'myBook'])->name('mybook');
    Route::get('export', [BookController::class, 'export'])->name('books.export');
});

// Route Category
Route::middleware('auth')->group(function () {
    Route::resource('categories', BookCategoryController::class)->middleware(CheckRole::class);
});