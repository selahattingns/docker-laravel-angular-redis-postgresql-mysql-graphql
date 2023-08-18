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


Route::group(['prefix' => "pages"], function (){
    Route::group(['prefix' => "posts"], function (){
        Route::get('/', [\App\Http\Controllers\Pages\PostController::class, 'getPostList']);

    });
});
