<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantController;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        Route::get('/', function () {
            return view('welcome');
        }); 
        Route::get('/csrf-token', function () {
            return response()->json(['csrf_token' => csrf_token()]);
        });

        Route::post('/registercompany', [TenantController::class, 'store']);
    });
}



