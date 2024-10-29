<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Classes\ApiResponseClass;
use App\Http\Resources\EmployeeResource;
use App\Interfaces\EmployeeRepositoryInterface;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    private EmployeeRepositoryInterface $employeeRepositoryInterface;
    
    public function __construct(EmployeeRepositoryInterface $employeeRepositoryInterface)
    {
        $this->employeeRepositoryInterface = $employeeRepositoryInterface;
    }

    public function index()
    {
        $data = $this->employeeRepositoryInterface->index();

        return ApiResponseClass::sendResponse(EmployeeResource::collection($data),'',200);
    }

    public function store(StoreEmployeeRequest $request)
    {
        $details =[
            'firstName' => $request->firstName,
            'lastName' => $request->lastName
        ];
        DB::beginTransaction();
        try{
             $employee = $this->employeeRepositoryInterface->store($details);

             DB::commit();
             return ApiResponseClass::sendResponse(new EmployeeResource($employee),'Employee Created Successfully',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

}
