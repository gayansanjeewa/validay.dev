<?php

namespace App\Http\Controllers;

use App\Services\DepartmentService;
use function MongoDB\BSON\toJSON;

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

    public function attach()
    {
        $data = request()->all();
        return $this->departmentService->attach($data);
    }
}
