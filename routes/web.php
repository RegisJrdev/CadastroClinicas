    <?php

    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\QuestionController;
    use App\Http\Controllers\TenantController;
    use App\Http\Services\Tenant\TenantService;
    use Illuminate\Foundation\Application;
    use Illuminate\Support\Facades\Route;
    use Inertia\Inertia;

    Route::get('/dashboard', [TenantController::class, 'index'])
        ->middleware(['auth', 'verified'])->name('dashboard');
        
    // Route::get('/', function () {
    //     return redirect(route('dashboard'));
    //     // return Inertia::render('Welcome', [
    //     //     'canLogin' => Route::has('login'),
    //     //     'canRegister' => Route::has('register'),
    //     //     'laravelVersion' => Application::VERSION,
    //     //     'phpVersion' => PHP_VERSION,
    //     // ]);
    // });

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });


    Route::post('/store', [TenantController::class, 'store'])->name('tenants.store');

    Route::delete('/delete', [TenantController::class, 'destroy'])->name('tenants.destroy');


    Route::post('/tenant_questions', [QuestionController::class, 'storeTenantQuestions'])->name('tenant_questions.store');

    // Route::get('/show', [TenantController::class , 'index'] )->name('tenants.index');

    // Route::middleware('tenant')->get('/teste', function () {
    //     return 'TENANT RESOLVIDO';
    // });


    require __DIR__ . '/auth.php';
    // require __DIR__ . '/admin.php';
