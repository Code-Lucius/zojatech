<?php

namespace App\Repositories;
use App\Models\Tenant;
use App\Models\Domain;
use Illuminate\Support\Facades\DB;
use App\Interfaces\TenantRepositoryInterface;

class TenantRepository implements TenantRepositoryInterface
{
    
    public function store(array $data){
        return DB::transaction(function () use ($data) {
            
            $tenant = Tenant::create([
                'id' => $data['id'],
            ]);

            // Create the related Domain record using tenant data
            $domain = Domain::create([
                'tenant_id' => $tenant->id,
                'domain' => $data['domain'],
            ]);

            // Return both records
            return ['tenant' => $tenant, 'domain' => $domain];
        });
     }
}
