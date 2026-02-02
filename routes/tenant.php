<?php

declare(strict_types=1);

use App\Http\Controllers\FormSubmissionController;
use App\Http\Controllers\PublicFormController;
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
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', [PublicFormController::class, 'show'])->name('public_form.show');
    Route::post('/public-form-store', [PublicFormController::class, 'store'])->name('public_form.store');

    Route::get('/form-submissions-index', [FormSubmissionController::class, 'index'])->name('form_submissions.index');
    Route::get('/form-submissions-show/{submission}', [FormSubmissionController::class, 'show'])->name('form_submissions.show');
});

Route::middleware('tenant')->get('/teste', function () {
    return [
        'host' => request()->getHost(),
        'tenant' => tenant('id'),
        'db' => config('database.connections.tenant.database'),
    ];
});


