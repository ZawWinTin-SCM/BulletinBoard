<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PasswordReset\PasswordResetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\User\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**
 * Post管理
 */
Route::prefix('post')->group(function () {
    Route::group(['middleware' => ['auth', 'prevent-back-history']], function () {
        Route::get('/create', [PostController::class, 'showPostCreateView']);
        Route::post('/create', [PostController::class, 'backPostCreateView']);
        Route::post('/create/confirm', [PostController::class, 'showPostCreateConfirmView']);
        Route::post('/save', [PostController::class, 'createPost']);
        Route::get('/edit/{postId}', [PostController::class, 'showPostEditView']);
        Route::post('/edit/confirm/{postId}', [PostController::class, 'showPostEditConfirmView']);
        Route::post('/update/{postId}', [PostController::class, 'updatePost']);
        Route::get('/delete/{postId}', [PostController::class, 'deletePost']);
        Route::get('/upload', [PostController::class, 'showPostUploadView']);
        Route::post('/upload', [PostController::class, 'importPosts']);
    });
    Route::get('/list', [PostController::class, 'showPostListView']);    
    Route::get('/download', [PostController::class, 'exportPosts']);
});

/**
 * Auth管理
 */
Route::prefix('auth')->group(function () {
    Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', [AuthController::class, 'showLoginView'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'authenticate']);
    });
    Route::group(['middleware' => ['auth', 'prevent-back-history']], function () {
        Route::get('/logout', [AuthController::class, 'logout']);
    });
});

Route::group(['middleware' => ['guest']], function () {
    Route::get('/forget-password', [PasswordResetController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('/forget-password', [PasswordResetController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('/reset-password', [PasswordResetController::class, 'submitResetPasswordForm'])->name('reset.password.post');
});

/**
 * User管理
 */
Route::prefix('user')->group(function () {    
    Route::group(['middleware' => ['auth', 'prevent-back-history']], function () {
        Route::get('/delete/{userId}', [UserController::class, 'deleteUser']);
        Route::get('/profile', [UserController::class, 'showUserProfileView']);
        Route::get('/profile/edit', [UserController::class, 'showUserProfileEditView']);
        Route::post('/profile/edit', [UserController::class, 'editProfile']);
        Route::get('/change-password', [UserController::class, 'showChangePasswordView']);
        Route::post('/change-password', [UserController::class, 'changePassword']);
    });
    Route::get('/create', [UserController::class, 'showUserCreateView']);
    Route::post('/create', [UserController::class, 'backUserCreateView']);
    Route::post('/create/confirm', [UserController::class, 'showUserCreateConfirmView']);
    Route::post('/save', [UserController::class, 'createUser']);
    Route::get('/list', [UserController::class, 'showUserListView']);
});

