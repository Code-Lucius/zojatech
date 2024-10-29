<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreTenantRequest;
use App\Interfaces\TenantRepositoryInterface;
use App\Classes\ApiResponseClass;
use App\Http\Resources\TenantResource;
use Illuminate\Support\Facades\DB;


class TenantController extends Controller
{
    private TenantRepositoryInterface $tenantRepositoryInterface;

    public function __construct(TenantRepositoryInterface $tenantRepositoryInterface)
    {
        $this->tenantRepositoryInterface = $tenantRepositoryInterface;
    }

    public function store(StoreTenantRequest $request)
    {
        $company =[
            'id' => $request->companyname,
            'domain' => $request->domain,
        ];

        DB::beginTransaction();
        try{
             $tenant = $this->tenantRepositoryInterface->store($company);

             DB::commit();
             return ApiResponseClass::sendResponse(new TenantResource($tenant),'Company added successfully',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }
}
