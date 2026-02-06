<?php

namespace App\Http\Services\Tenant;

use App\Models\Tenant;
use Illuminate\Support\Facades\Storage;
use Stancl\Tenancy\Database\Models\Domain;

class TenantCreateService
{
    public function execute(array $data): Tenant
    {
        $tenantData = [
            'id'        => $data['name'],
            'name'      => $data['name'],
            'subdomain' => $data['subdomain'],
        ];

        if (isset($data['photo']) && $data['photo']) {
            $tenantData['photo_path'] = $data['photo']->store('tenants', 'public');
        }

        if (isset($data['bg_color']) && $data['bg_color']) {
            $tenantData['bg_color'] = $data['bg_color'];
        }

        $tenant = Tenant::create($tenantData);

        $subdomain = $data['subdomain'] . '.localhost';

        if (Domain::where('domain', $subdomain)->exists()) {
            throw new \Exception('Subdomínio em uso');
        }

        $tenant->domains()->create([
            'domain' => $subdomain,
        ]);

        return $tenant;
    }
}