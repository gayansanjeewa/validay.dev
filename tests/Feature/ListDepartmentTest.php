<?php

namespace Tests\Feature;

use App\Department;
use App\Employee;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ListDepartmentTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;


    /**
     * @test
     */
    public function it_lists_department_in_expected_format()
    {
        $parentDepartment = factory(Department::class)->create();
        $childDepartment = factory(Department::class)->create(['parent_id' => $parentDepartment->id]);

        $json = [
            'departments' => [
                [
                    'id' => $parentDepartment->id,
                    'name' => $parentDepartment->name,
                    'parent_id' => $parentDepartment->parent_id,
                    'departments' => [
                         [
                            'id' => $childDepartment->id,
                            'name' => $childDepartment->name,
                            'parent_id' => $childDepartment->parent_id,
                        ]
                    ]
                ]
            ]
        ];

        $this->json('GET', 'api/department/all')
            ->assertJson($json);
    }
}
