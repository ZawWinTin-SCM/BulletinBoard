<?php

use App\Http\Controllers\API\Post\PostAPIController;
use App\Http\Controllers\API\User\UserAPIController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/**
 * To Update Post
 */
Route::post('/post/edit/{postId}', [PostAPIController::class, 'updatePost']);

/**
 * To Show Post Detail
 */
Route::get('/post/{postId}', [PostAPIController::class, 'showPostDetail']);

/**
 * To Create User
 */
Route::post('/user/create', [UserAPIController::class, 'createUser']);

/**
 * To Show User Detail
 */
Route::get('/user/{userId}', [UserAPIController::class, 'showUserDetail']);