<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\Response;
class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        dd(env('APP_URL'));
      //  $response = $this->get('/');

      //  $response->assertStatus(200);
    }
    public function testIndexReturnsDataInValidFormat() {
        $data = ['data' => ['name','course']];
        $this->json('get', 'api/students')
             ->assertStatus(Response::HTTP_OK)
             ->assertJsonStructure([
                  '*' => [
                    'id',
                    'name',
                    'course',
                    'created_at',
                    'updated_at'
                  ]
              ]);
            // ->assertJsonStructure(['data' => ['id','name', 'course','created_at','updated_at']]);
      }

public function testUserIsCreatedSuccessfully() {

        $payload =
            ['name' => 'rrrrr', 'course' => 'tttt']
        ;
        $this->json(
            'POST', //Method
            '/api/students', //Route
            $payload, //JSON Body request

        )
        ->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas('students', [
            'name' => $payload['name']
        ]);
    }

public function testUserIsUpdatedSuccessfully(){
    $payload = [
        'name' => 'phyophyo'
    ];

    $this->json(
        'PUT', //Method
        '/api/students/3', //Route
        $payload //JSON Body request

    )
    ->assertStatus(Response::HTTP_OK);
}

public function testUserIsDeletedSuccessfully(){

    $this->json(
        'delete', //Method
        '/api/students/12' //Route

    )
    ->assertStatus(Response::HTTP_ACCEPTED);
}
}
