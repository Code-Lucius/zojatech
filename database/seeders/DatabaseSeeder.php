<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tenant;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $tenant = Tenant::query()->create(
            attributes: [
                'id' => 'judith',
            ],
        );
        
        $tenant->domains()->create(
            attributes: [
                'domain' => 'judith.localhost',
            ]
        );

        $tenant = Tenant::query()->create(
            attributes: [
                'id' => 'emeka',
            ],
        );
        
        $tenant->domains()->create(
            attributes: [
                'domain' => 'emeka.localhost',
            ]
        );
    }
}
