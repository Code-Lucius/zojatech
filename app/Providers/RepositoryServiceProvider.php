<?php

namespace App\Providers;

use App\Interfaces\DepartmentRepositoryInterface;
use App\Interfaces\EmployeeRepositoryInterface;
use App\Repositories\EmployeeRepository;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\TenantRepositoryInterface;
use App\Repositories\DepartmentRepository;
use App\Repositories\TenantRepository;
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TenantRepositoryInterface::class,TenantRepository::class);

        $this->app->bind(EmployeeRepositoryInterface::class,EmployeeRepository::class);

        $this->app->bind(DepartmentRepositoryInterface::class,DepartmentRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}