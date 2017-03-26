<?php

namespace App\Services;

use App\Department;
use App\Employee;
use App\Exceptions\InvalidDepartmentException;
use Services\Contracts\EmployeeServiceInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EmployeeService
{

    public function create($data)
    {
        $employee = unwrap($data, STEP1)['employee'];
        // TODO: validate
        return Employee::create($employee);
    }
}
