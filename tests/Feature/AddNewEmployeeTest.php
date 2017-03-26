<?php

namespace Tests\Feature;

use App\Department;
use App\Employee;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AddNewEmployeeTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * @test
     */
    public function it_creates_a_new_employee()
    {
        $postData = [
            'data' => [
                'employee' => [
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                ]
            ]
        ];

        $this->call('POST', 'api/employee', $postData)
            ->assertStatus(200);
    }
}
