<?php

use App\Http\Controllers\ChannelsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UpdateProfileTicketController;
use App\Http\Controllers\UserController;
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

Route::post('/user/login', [UserController::class, 'login']);
Route::post('/user/signup', [UserController::class, 'signup']);

Route::get('/channels/list', [ChannelsController::class, 'list']);



Route::middleware(['isAuth'])->group(function () {
    Route::get('/news-club/account', [UserController::class, 'show']);
    Route::put('/news-club/update-account-ticket', [UpdateProfileTicketController::class, 'updateAccount']);
    Route::delete('/news-club/delete-account-ticket', [UpdateProfileTicketController::class, 'removeAccount']);


    Route::post('/news-club/post-news-ticket', [NewsController::class, 'new']);
    Route::get('/news-club/last-news/{channelId}', [NewsController::class, 'last']);
});


Route::middleware(['isAuth', 'isAdmin'])->prefix('admin')->group(function () {
    Route::put('/news/confirm/{id}', [NewsController::class, 'confirm']);
});
