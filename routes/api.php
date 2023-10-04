<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// User routes
Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');
Route::middleware('auth:api')->post('/logout', 'UserController@logout');

// Post routes
Route::middleware('auth:api')->get('/posts', 'PostController@index');
Route::middleware('auth:api')->post('/posts', 'PostController@store');
Route::middleware(['auth:api', 'owns.post'])->put('/posts/{id}', 'PostController@update');
Route::middleware(['auth:api', 'owns.post'])->delete('/posts/{id}', 'PostController@destroy');

// Middleware to check if the user owns the post
Route::middleware(['auth:api', 'owns.post'])->group(function () {
    Route::put('/posts/{id}', 'PostController@update');
    Route::delete('/posts/{id}', 'PostController@destroy');
});
