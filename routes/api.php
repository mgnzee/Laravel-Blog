<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::post('/users', [UserController::class, 'store']);
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'find']);
Route::get('/users/{id}/posts', [UserController::class, 'getPosts']);
Route::patch('/users/{id}', [UserController::class, 'update']);
Route::patch('/users/{id}/password', [UserController::class, 'updatePassword']);
Route::patch('/users/{id}/email', [UserController::class, 'updateEmail']);
Route::delete('/users/{id}', [UserController::class, 'delete']);


Route::post('/posts', [PostController::class, 'store']);
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'find']);
Route::patch('/posts/{id}', [PostController::class, 'update']);
Route::delete('/posts/{id}', [PostController::class, 'delete']);
