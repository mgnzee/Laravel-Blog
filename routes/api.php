<?php

use App\Http\Controllers\UserController;

Route::post('/users', [UserController::class, 'store']);
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'find']);
Route::patch('/users/{id}', [UserController::class, 'update']);
Route::patch('/users/{id}/password', [UserController::class, 'updatePassword']);
Route::patch('/users/{id}/email', [UserController::class, 'updateEmail']);
Route::delete('/users/{id}', [UserController::class, 'delete']);
