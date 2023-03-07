<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StoryController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('category', 'App\Http\Controllers\CategoryController');
Route::post('category-posts/{id}', 'App\Http\Controllers\CategoryController@posts');
Route::resource('post', 'App\Http\Controllers\PostController');
Route::resource('story', 'App\Http\Controllers\StoryController');
Route::resource('blog', 'App\Http\Controllers\BlogController');