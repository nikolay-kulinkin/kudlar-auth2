<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[PostController::class,'index'])->name('home');

Route::middleware('guest')->group(function(){
    Route::get('/register',[UserController::class,'create'])->name('register.create');
    Route::post('/register',[UserController::class,'store'])->name('register.store');
    Route::get('/login',[UserController::class,'loginForm'])->name('login');
    Route::post('/login',[UserController::class,'loginAuth'])->name('login.auth');
});

Route::middleware('auth')->group(function(){
    Route::get('/logout',[UserController::class,'logout'])->name('logout');
    Route::get('/posts/create',[PostController::class,'create'])->name('posts.create');
    Route::post('/posts',[PostController::class,'store'])->name('posts.store');
    Route::get('/posts/{id}/edit',[PostController::class,'edit'])->name('posts.edit');
    Route::put('/posts/{id}',[PostController::class,'update'])->name('posts.update');
    Route::delete('/posts/{id}',[PostController::class,'destroy'])
                  ->name('posts.destroy')->can('delete-post');
});
