<?php

declare(strict_types=1);

use App\Http\Controllers\FormSubmissionController;
use App\Http\Controllers\PublicFormController;
use App\Http\Controllers\Tenant\TenantAuthController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', [PublicFormController::class, 'show'])->name('public_form.show');
    Route::post('/public-form', [PublicFormController::class, 'store'])->name('public_form.store');

    Route::get('/admin/login', [TenantAuthController::class, 'showLoginForm'])->name('tenant.login');
    Route::post('/admin/login', [TenantAuthController::class, 'login']);

    Route::middleware('auth')->group(function () {
        Route::post('/admin/logout', [TenantAuthController::class, 'logout'])->name('tenant.logout');

        Route::get('/form-submissions', [FormSubmissionController::class, 'index'])->name('form_submissions.index');
        Route::get('/form-submissions/report', [FormSubmissionController::class, 'reportPdf'])->name('form_submissions.report');
        Route::get('/form-submissions/{submission}', [FormSubmissionController::class, 'show'])->name('form_submissions.show');
        Route::get('/form-submissions/{submission}/pdf', [FormSubmissionController::class, 'downloadPdf'])->name('form_submissions.pdf');
    });
});

Route::middleware('tenant')->get('/teste', function () {
    return [
        'host' => request()->getHost(),
        'tenant' => tenant('id'),
        'db' => config('database.connections.tenant.database'),
    ];
});