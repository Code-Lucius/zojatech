<?php

namespace App\Interfaces;

interface EmployeeRepositoryInterface
{
    public function index();
    public function store(array $data);
    
}
