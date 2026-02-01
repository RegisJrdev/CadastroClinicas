<?php

namespace App\Http\Controllers;

use App\Http\Requests\TenantStoreRequest;
use App\Http\Services\Tenant\TenantAllService;
use App\Http\Services\Tenant\TenantDeleteService;
use App\Http\Services\Tenant\TenantService;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TenantController extends Controller
{
    public function __construct(
        private TenantService $tenantService,
        private TenantAllService $tenantAllService,
        private TenantDeleteService $tenantDeleteService
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->tenantAllService->execute();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TenantStoreRequest $request)
    {
        $data = $request->validated();
        $tenant = $this->tenantService->store($data);

        return redirect(route('dashboard'))
            ->with('sucess', 'Tenant criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) {
        dd($request->all());
        return $this->tenantDeleteService->execute($id);
    }
}
