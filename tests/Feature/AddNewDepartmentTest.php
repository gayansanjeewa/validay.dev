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
        //Given I wan't to create a department
        //When I creates a new department
        //Then successfully creates a department

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

}
