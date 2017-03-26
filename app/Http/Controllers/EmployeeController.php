<?php

namespace App\Http\Controllers;

use App\Services\EmployeeService;

class EmployeeController extends Controller
{
    /**
     * @var EmployeeService
     */
    private $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function create()
    {
        $data = request()->all();
        return $this->employeeService->create($data);
    }
}
