<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login'); // Redirect root to login
});

// Authentication Routes
Route::get('login', [AuthController::class,'index'])->name('login'); 
Route::get('registration', [AuthController::class,'registration'])->name('registration'); 
Route::post('post-registration', [AuthController::class,'postRegistration'])->name('registration.post');
Route::post('post-login', [AuthController::class,'postLogin'])->name('login.post');
Route::get('logout', [AuthController::class,'logout'])->name('logout'); 

// Protected Routes
Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [AuthController::class,'dashboard'])->name('dashboard'); 
    Route::resource('products', ProductController::class);
});


