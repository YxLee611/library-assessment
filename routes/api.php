<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookBorrowController;
use App\Http\Controllers\StatisticsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);

// Admin
Route::get('/statistics', [StatisticsController::class, 'getStatistics']);

// User
Route::get('/user', [UserController::class, 'getUserData']);
Route::get('/users', [UserController::class, 'fetchAllUsers']);
Route::post('/user', [UserController::class, 'createUser']);
Route::post('/users/{id}', [UserController::class, 'updateUser']);
Route::delete('/users/{id}', [UserController::class, 'deleteUser']);

// Books
Route::get('/books', [BookController::class, 'fetchAllBooks']);
Route::post('/book', [BookController::class, 'createBook']);
Route::get('/top-books', [BookController::class, 'topBooks']);
Route::post('/book/{id}', [BookController::class, 'updateBook']);
Route::delete('/book/{id}', [BookController::class, 'deleteBook']);

// Borrow Books
Route::post('/books/borrow', [BookBorrowController::class, 'borrow']);
Route::get('/borrowed-books', [BookBorrowController::class, 'borrowedBooksList']);
