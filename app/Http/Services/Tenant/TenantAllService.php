<?php

namespace App\Http\Services\Tenant;

use App\Models\Tenant;
use Inertia\Inertia;

class TenantAllService
{
    public function execute()
    {
        $tenants = Tenant::query()
            ->with(['domain' => fn ($query) =>
                $query->select('id', 'tenant_id', 'domain')
            ])
            ->latest()
            ->paginate();

        return Inertia::render('Dashboard', [
            'tenants' => $tenants
        ]);
    }
}
