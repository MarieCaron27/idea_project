<?php

use App\Http\Controllers\IdeaController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;

// Route::get('/', fn () => view('welcome'));
Route::redirect('/', '/ideas');

// Get all ideas
Route::get('/ideas', [IdeaController::class, 'index'])->name('idea.index')->middleware('auth');

// Get one idea
Route::get('/ideas/{idea}', [IdeaController::class, 'show'])->name('idea.show')->middleware('auth');

// Delete one idea
Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy'])->name('idea.destroy')->middleware('auth');

// Create User
Route::get('/auth/register', [RegisteredUserController::class, 'create'])->middleware('guest');

// Store User
Route::post('/auth/register', [RegisteredUserController::class, 'store'])->middleware('guest');

// Create User's session
Route::get('/auth/login', [SessionsController::class, 'create'])->name('login')->middleware('guest');

// Store User's session
Route::post('/auth/login', [SessionsController::class, 'store'])->middleware('guest');

// Delete User's session
Route::post('/logout', [SessionsController::class, 'destroy'])->middleware('auth');
