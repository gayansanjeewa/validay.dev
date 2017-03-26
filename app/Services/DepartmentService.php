<?php

namespace App\Services;

use App\Department;
use App\Exceptions\InvalidParentDepartmentGiven;
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

    public function create($data)
    {
        $department = unwrap($data, STEP1)['department'];
        if ($this->canAttachToParent($department)) {
            return $this->attachToParent($department);
        }
        return Department::create($department);
    }

    private function canAttachToParent($department)
    {
        return !empty($department['parent_id']);
    }

    private function attachToParent($department)
    {
        $this->validParent($department['parent_id']);
        return Department::create($department);
    }

    private function validParent($parentId)
    {
        if (empty(Department::find($parentId))) {
            throw new InvalidParentDepartmentGiven('Invalid parent Id');
        }
    }
}
