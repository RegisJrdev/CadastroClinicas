<?php

namespace App\Http\Services\Tenant;

use App\Models\Tenant;
use Illuminate\Support\Facades\Storage;

class TenantUpdateService
{
    public function execute(Tenant $tenant, array $data)
    {
        $updateData = [
            'name' => $data['name'],
        ];

        if (isset($data['photo']) && $data['photo']) {
            if ($tenant->photo_path) {
                Storage::disk('public')->delete($tenant->photo_path);
            }
            $updateData['photo_path'] = $data['photo']->store('tenants', 'public');
        }

        if (isset($data['bg_color'])) {
            $updateData['bg_color'] = $data['bg_color'];
        }

        $tenant->update($updateData);

        if (isset($data['subdomain']) && $data['subdomain'] !== '') {
            $domain = $tenant->domain()->first();
            if ($domain) {
                $newDomain = $data['subdomain'] . '.' . config('app.domain');
                $domain->update(['domain' => $newDomain]);
            }
        }

        return $tenant->fresh();
    }
}
