<?php

namespace App\Http\Controllers;

use App\Services\DepartmentService;

class DepartmentController extends Controller
{
    private $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
//        $this->middleware('jwt.auth', ['except' => ['index']]);
        $this->departmentService = $departmentService;
    }

    public function index()
    {
        $data = request()->all();
        return $this->departmentService->create($data);
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

    public function all()
    {
        return $this->departmentService->all();
    }
}
