<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;

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

// User
Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'getUserData']);
Route::middleware('auth:sanctum')->get('/users', [UserController::class, 'fetchAllUsers']);

// Books
Route::middleware('auth:sanctum')->get('/books', [BookController::class, 'fetchAllBooks']);
