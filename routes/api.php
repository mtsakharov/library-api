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
Route::post('register', [\App\Http\Controllers\Api\Auth\RegisterController::class, 'register'])->name('register');
Route::post('login', [\App\Http\Controllers\Api\Auth\LoginController::class, 'login'])->name('login');
Route::post('forgot-password', [\App\Http\Controllers\Api\Auth\ForgotResetController::class, 'forgot'])->name('forgot');
Route::post('reset-password', [\App\Http\Controllers\Api\Auth\ForgotResetController::class, 'reset'])->name('reset');
Route::middleware('auth:sanctum')->group(function (){
    Route::post('logout', [\App\Http\Controllers\Api\Auth\LoginController::class, 'logout'])->name('logout');
    Route::apiResources([
        'authors' => \App\Http\Controllers\Api\AuthorController::class,
        'books' => \App\Http\Controllers\Api\BookController::class,
        'librarians' => \App\Http\Controllers\Api\LibrarianController::class,
        'users' => \App\Http\Controllers\Api\UserController::class
    ]);
});
