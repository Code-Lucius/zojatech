<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Classes\ApiResponseClass;
use App\Http\Resources\DepartmentResource;
use App\Interfaces\DepartmentRepositoryInterface;
use Illuminate\Support\Facades\DB;


class DepartmentController extends Controller
{
    private DepartmentRepositoryInterface $departmentRepositoryInterface;
    
    public function __construct(DepartmentRepositoryInterface $departmentRepositoryInterface)
    {
        $this->departmentRepositoryInterface = $departmentRepositoryInterface;
    }

    public function index()
    {
        $data = $this->departmentRepositoryInterface->index();

        return ApiResponseClass::sendResponse(DepartmentResource::collection($data),'',200);
    }

    public function store(StoreDepartmentRequest $request)
    {
        $details =[
            'department' => $request->department,
        ];
        DB::beginTransaction();
        try{
             $department = $this->departmentRepositoryInterface->store($details);

             DB::commit();
             return ApiResponseClass::sendResponse(new DepartmentResource($department),'Department Added Successfully',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    public function update(UpdateDepartmentRequest $request, $id)
    {
        $updateDetails =[
            'employee_id' => $request->employee,
        ];
        DB::beginTransaction();
        try{
             $department = $this->departmentRepositoryInterface->update($updateDetails,$id);

             DB::commit();
             return ApiResponseClass::sendResponse('Department Update Successful','',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }
}
