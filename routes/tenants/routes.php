<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;


Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });


    Route::post('/addemployee', [EmployeeController::class, 'store']);


    Route::get('/csrf-token', function () {
        return response()->json(['csrf_token' => csrf_token()]);
    });

    Route::get('/listemployee', [EmployeeController::class, 'index']);

    Route::get('/listdepartment', [DepartmentController::class, 'index']);

    
    Route::post('/adddepartment', [DepartmentController::class, 'store']);


    Route::put('/assigndepartmenthead/{id}', [DepartmentController::class, 'update']);


});