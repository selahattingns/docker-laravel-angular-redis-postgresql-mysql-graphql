<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::middleware('check.jwt')->group(function () {
    Route::post('check-token', [\App\Http\Controllers\AuthController::class, 'checkToken']);
});


Route::group(['prefix' => 'pages', 'middleware' => 'check.jwt'], function (){
    Route::group(['prefix' => "posts"], function (){
        Route::get('/', [\App\Http\Controllers\Pages\PostController::class, 'getPostList']);
        Route::post('/', [\App\Http\Controllers\Pages\PostController::class, 'storePost']);
        Route::delete('/{id}', [\App\Http\Controllers\Pages\PostController::class, 'deletePost']);
        Route::patch('/', [\App\Http\Controllers\Pages\PostController::class, 'updatePost']);
    });

    Route::group(['prefix' => "comments"], function (){
        Route::get('/', [\App\Http\Controllers\Pages\CommentController::class, 'getCommentList']);
        Route::post('/', [\App\Http\Controllers\Pages\CommentController::class, 'storeComment']);
        Route::delete('/{id}', [\App\Http\Controllers\Pages\CommentController::class, 'deleteComment']);
        Route::patch('/', [\App\Http\Controllers\Pages\CommentController::class, 'updateComment']);
    });
});
