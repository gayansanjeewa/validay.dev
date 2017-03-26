<?php

namespace Tests\Unit;

use App\Department;
use App\Employee;
use App\Services\DepartmentService;
use Mockery;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DepartmentServiceTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * @test
     */
    public function the_department_can_be_found_by_its_name()
    {
        // Given I have a department in the database
        $existingDepartment = factory(Department::class)->create(['name' => 'hr']);

        // When I search for it by its name
        $searchingDepartment = Department::findByName('hr');

        // Then I find that department
        $this->assertEquals($searchingDepartment->id, $existingDepartment->id);
        $this->assertEquals($searchingDepartment->name, $existingDepartment->name);
    }

    /**
     * @test
     */
    public function it_returns_employees_for_a_given_department()
    {
        // Given I have a department in the database
        // And that department can have many employees
        $department = factory(Department::class)->create();
        $employee = factory(Employee::class)->create();
        $employee->departments()->attach($department);

        // When I search for it by its name
        $search = Department::findByName($department->name, ['employees'])->toArray();

        // Then I find that department with its employees
        $this->assertNotEmpty($search['employees']);
    }

//    /**
//     * @test
//     */
//    public function the_created_department_exists_in_db()
//    {
//        $postData = [
//            'name' => 'Hr',
//            'parent_id' => null
//        ];
//
//        $departmentService = Mockery::mock(DepartmentService::class);
//        $departmentService->shouldReceive('create')->once()->andReturn('mocked');
//
//        $search = Department::findByName($department->name);
//
//        $this->assertEquals($search->name, $department->name);
//    }
}
