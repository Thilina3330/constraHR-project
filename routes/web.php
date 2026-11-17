<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/create-site',[App\Http\Controllers\SiteController::class,'index']);
Route::post('/store_site', [App\Http\Controllers\SiteController::class,'store']) ;
Route::get('/view-site', [App\Http\Controllers\SiteController::class, 'viewSite']);
Route::get('/employe', [App\Http\Controllers\EmployeeController::class, 'index']);
// Employee Management Routes
Route::get('/employees', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employees.index');
Route::get('/employees/create', [App\Http\Controllers\EmployeeController::class, 'create'])->name('employees.create');
Route::post('/employees/store', [App\Http\Controllers\EmployeeController::class, 'store'])->name('employees.store');