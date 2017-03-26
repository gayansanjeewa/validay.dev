<?php

namespace Tests\Feature;

use App\Department;
use App\Employee;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AddNewDepartmentTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * @test
     */
    public function it_creates_a_new_department()
    {
        $postData = [
            'data' => [
                'department' => [
                    'name' => 'Hr',
                    'parent_id' => null
                ]
            ]
        ];

        $this->json('POST', 'api/department', $postData)
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_attach_employee_to_a_department()
    {
        $department = factory(Department::class)->create();
        $employee = factory(Employee::class)->create();

        $postData = [
            'data' => [
                'attach' => [
                    "department_id" => $department->id,
                    "employee_id" => $employee->id
                ]
            ]
        ];

        $this->json('POST', 'api/department/attach', $postData)
            ->assertStatus(200);
    }
}
