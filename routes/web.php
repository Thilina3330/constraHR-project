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

// Authentication Routes (Login, Register, Logout ආදිය)
Auth::routes();

// Dashboard
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Authenticated Routes (Login වූ අයට පමණක් ප්‍රවේශ විය හැකි පරිදි)
Route::middleware(['auth'])->group(function () {
    
    // --- 🏗️ Site Management Routes ---
    Route::get('/view-site', [SiteController::class, 'viewSite'])->name('site.view');
    Route::get('/create-site', [SiteController::class, 'index'])->name('site.create');
    Route::post('/store_site', [SiteController::class, 'store'])->name('site.store');
    Route::get('/site-details/{id}', [SiteController::class, 'show'])->name('site.show');

    // --- 💰 Expenses Routes ---
    Route::get('/expenses', [SiteExpenseController::class, 'index'])->name('expenses.index');
    Route::post('/expenses/store', [SiteExpenseController::class, 'store'])->name('expenses.store');

    // --- 👷 Employee Route (දැනට ඇති) ---
    Route::get('/employe', [EmployeeController::class, 'index'])->name('employe.index');
});