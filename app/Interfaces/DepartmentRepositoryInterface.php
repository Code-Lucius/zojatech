<?php

namespace App\Interfaces;

interface DepartmentRepositoryInterface
{
    public function index();
    
    public function update(array $data,$id);

    public function store(array $data);
}
