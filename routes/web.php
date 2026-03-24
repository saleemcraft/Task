<?php

use App\Http\Controllers\Productcontroller;
use Illuminate\Support\Facades\Route;

Route::get('/',[Productcontroller::class,'index']);
Route::get('products/create',[Productcontroller::class,'create']);
Route::post('products/store',[Productcontroller::class,'store']);
Route::get('products/show/{id}',[Productcontroller::class,'show']);
Route::get('products/edit/{id}',[Productcontroller::class,'edit']);
Route::put('products/update/{id}',[Productcontroller::class,'update']);
Route::get('products/delete/{id}',[Productcontroller::class,'destroy']);



