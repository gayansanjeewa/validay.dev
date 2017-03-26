<?php

namespace App\Services;

use App\Department;
use App\Exceptions\InvalidDepartmentException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DepartmentService
{
    protected $department;
    protected $employee;

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
            throw new InvalidDepartmentException('Invalid parent id');
        }
    }

    public function attach($data)
    {
        $data = unwrap($data, STEP1)['attach'];
        $this->validateDepartment($data['department_id']);
        $this->validateEmployee($data['employee_id']);
        return $this->associate();
    }

    private function validateDepartment($departmentId)
    {
        $this->department = Department::find($departmentId);
        if (empty($this->department)) {
            throw new InvalidDepartmentException('Invalid department id');
        }
    }

    private function validateEmployee($employeeId)
    {
        $this->employee = Department::find($employeeId);
        if (empty($this->employee)) {
            throw new InvalidDepartmentException('Invalid department id');
        }
    }

    private function associate()
    {
        $this->department->employees()->detach($this->employee);
        $this->department->employees()->attach($this->employee);

        $responce = 'success';
        return response()->json(compact('responce'));
    }

}
