<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Models\Domain;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array',
    ];

    protected $appends = [
        'tenant_domain',
    ];

    public function domain()
    {
        return $this->hasMany(Domain::class);
    }

    public static function generateDatabaseName(string $subdomain): string
    {
        return 'tenant_' . str_replace('-', '_', $subdomain);
    }

    public function getTenantDomainAttribute()
{
    return $this->domain->first()?->domain;
}
}
