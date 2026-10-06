<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/create-site',[App\Http\Controllers\SiteController::class,'index']);
Route::post('/store_site', [App\Http\Controllers\SiteController::class,'store']) ;
