<?php

namespace App\Http\Services\Tenant;

use App\Models\Tenant;
use PhpParser\Node\Expr\Array_;
use Stancl\Tenancy\Database\Models\Domain;

class TenantCreateService
{
    public function execute(array $data): Tenant
{
     $tenant = Tenant::create([
        'id'   => $data['name'], 
        'name' => $data['name'],     
        'subdomain' => $data['subdomain'],  
    ]);

    $subdomain = $data['subdomain'] . '.localhost';

    if (Domain::where('domain', $subdomain)->exists()) {
        throw new \Exception('Subdomínio em uso');
    };

    $tenant->domains()->create([
        'domain' => $data['subdomain'] . '.localhost'
    ]);

    return $tenant;
}

}