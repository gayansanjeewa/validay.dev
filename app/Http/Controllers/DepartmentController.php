<?php

namespace App\Http\Controllers;

use App\Services\DepartmentService;

class DepartmentController extends Controller
{
    private $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function create()
    {
        $data = request()->all();
        return $this->departmentService->create($data);
    }

    public function employees($department)
    {
        return $this->departmentService->employeesForDepartment($department);
    }
}
