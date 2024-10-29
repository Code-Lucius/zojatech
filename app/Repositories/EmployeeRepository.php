<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Interfaces\EmployeeRepositoryInterface;
use App\Models\Employee;

class EmployeeRepository implements EmployeeRepositoryInterface
{
     public function index(){
        return Employee::all();
    }

    public function store(array $data){
        return Employee::create($data);
     }

}
