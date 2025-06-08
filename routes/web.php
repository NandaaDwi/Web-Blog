<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\admin\AdminCategoryController;
use \App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\Admin\AdminCommentController;
use App\Http\Controllers\Admin\AdminActivityLogController;
use App\Http\Controllers\editor\ArticleController;
use App\Http\Controllers\editor\DashboardController;
use \App\Http\Controllers\Editor\CommentController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\UserArticleController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/artikel/{slug}', [UserArticleController::class, 'show'])->name('user.articles.show');
Route::post('/artikel/{slug}/komentar', [UserArticleController::class, 'storeComment'])->name('user.articles.comment')->middleware('auth');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [AuthController::class, 'forgotForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::put('/profile/photo', [PhotoController::class, 'updatePhoto'])->name('profile.photo.update');
});

Route::prefix('admin')->as('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', AdminUserController::class);
    Route::resource('category', AdminCategoryController::class);
    Route::resource('articles', AdminArticleController::class);
    Route::post('articles/upload-image', [AdminArticleController::class, 'uploadImage'])->name('articles.uploadImage');
    Route::resource('comments', AdminCommentController::class)->only(['index', 'destroy']);
    Route::get('logs', [AdminActivityLogController::class, 'index'])->name('logs.index');
});


Route::prefix('editor')->as('editor.')->middleware(['auth', 'editor'])->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::resource('articles', ArticleController::class);
  Route::post('/articles/upload-image', [ArticleController::class, 'uploadImage'])->name('articles.uploadImage');
  Route::resource('comments', CommentController::class)->only(['index', 'destroy']);
});

Route::prefix('user')->as('user.')->middleware(['auth', 'user'])->group(function () {
  // Route::get('/', [HomeController::class, 'index'])->name('home');
});

