<?php

use Illuminate\Support\Facades\Route;
use App\Admin\Controllers\QuestionController;
use App\Http\Controllers\TenantController;
use Inertia\Inertia;

// Rotas do Dashboard Admin (usa banco master)
Route::prefix('admin')->name('admin.')->middleware(['web', 'auth'])->group(function () {
    
    Route::get('/', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // CRUD de Tenants
    Route::resource('tenants', TenantController::class);
    Route::post('tenants/{tenant}/questions', [TenantController::class, 'attachQuestions'])
         ->name('tenants.attach-questions');

    // CRUD de Perguntas
    // Route::resource('questions', QuestionController::class);
});