<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SiteExpenseController;
use App\Http\Controllers\EmployeeController;

// Landing Page
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes (Login, Register, Logout)
Auth::routes();

// Dashboard
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    
    // --- 🏗️ Site Management Routes ---
    Route::get('/view-site', [SiteController::class, 'viewSite'])->name('site.view');
    Route::get('/create-site', [SiteController::class, 'index'])->name('site.create');
    Route::post('/store_site', [SiteController::class, 'store'])->name('site.store');
    Route::get('/site-details/{id}', [SiteController::class, 'show'])->name('site.show');

    // --- 💰 Expenses Routes ---
    Route::get('/expenses', [SiteExpenseController::class, 'index'])->name('expenses.index');
    Route::post('/expenses/store', [SiteExpenseController::class, 'store'])->name('expenses.store');

    // --- 👷 Employee Management Routes ---
    Route::get('/employe', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('/create-employee', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/store-employee', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/employee/success/{id}', [EmployeeController::class, 'success'])->name('employee.success');
});