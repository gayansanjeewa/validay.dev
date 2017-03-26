<?php

namespace Tests\Feature;

use App\Department;
use App\Employee;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ListEmployeesOfAGivenDepartmentTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * @test
     */
    public function it_has_a_service_for_listing_employees_for_a_given_department()
    {
        $department = factory(Department::class)->create();
        $this->json('GET', 'api/department/' . $department->name . '/employees')
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_lists_employees_of_a_given_department_in_expected_format()
    {
        $department = factory(Department::class)->create();
        $employee = factory(Employee::class)->create();
        $employee->departments()->attach($department);

        $json = [
            'employees' => [
                [
                    'id' => $employee->id,
                    'first_name' => $employee->first_name,
                    'last_name' => $employee->last_name
                ]
            ]
        ];

        $this->json('GET', 'api/department/' . $department->name . '/employees')
            ->assertJson($json);
    }

    /**
     * @test
     */
    public function it_404_if_invalid_department_is_given()
    {
        $department = factory(Department::class)->create();

        $searchFor = 'not_that_' . $department->name;

        $this->json('GET', 'api/department/' . $searchFor . '/employees')
            ->assertStatus(404);
    }
}
