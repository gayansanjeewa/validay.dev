<?php

namespace App\Services;

use App\Department;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DepartmentService
{
    public function employeesForDepartment($department)
    {
        $department = Department::findByName($department, ['employees']);
        if (empty($department)) {
            throw new NotFoundHttpException('Department Not Found!');
        }

        $employees = $department->toArray()['employees'];
        return response()->json(compact('employees'));
    }
}
