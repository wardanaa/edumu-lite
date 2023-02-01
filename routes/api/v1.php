<?php

use App\Http\Controllers\Api\V1\ContentController;
use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\DashboardController;
use Illuminate\Http\Request;

Route::get('/',function(Request $request){
    return 'Hello API';
});

Route::post('login', [CustomerController::class, 'login']);
Route::post('register', [CustomerController::class, 'register']);

Route::get('dashboard', [DashboardController::class, 'index']);
Route::get('content', [ContentController::class, 'content']);

Route::get('content/ebook', [ContentController::class, 'ebook']);
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('check-auth', [CustomerController::class, 'checkAuth']);
    Route::post('edit-photo', [CustomerController::class, 'editPhoto']);
    Route::post('change-password', [CustomerController::class, 'changePassword']);
    Route::post('update-profile', [CustomerController::class, 'updateProfile']);

    Route::get('content/detail', [ContentController::class, 'detail']);
    Route::get('content/download/{filename}', [ContentController::class, 'download']);
    Route::post('content/create', [ContentController::class, 'create']);
    Route::post('content/rating', [ContentController::class, 'rating']);
    Route::get('content/comment', [ContentController::class, 'comment']);

    Route::post('content/comment/create', [ContentController::class, 'commentCreate']);



});