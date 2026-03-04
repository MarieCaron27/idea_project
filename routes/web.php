<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionsController;

Route::get('/', fn () => view('welcome'));

//Create User
Route::get('/auth/register', [RegisteredUserController::class, 'create'])->middleware('guest');

//Store User
Route::post('/auth/register', [RegisteredUserController::class, 'store'])->middleware('guest');

//Create User's session
Route::get('/auth/login', [SessionsController::class, 'create'])->middleware('guest');

//Store User's session
Route::post('/auth/login', [SessionsController::class, 'store'])->middleware('guest');

//Delete User's session
Route::post('/logout', [SessionsController::class, 'destroy'])->middleware('auth');