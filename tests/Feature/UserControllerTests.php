<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
//use Tests\DuskTestCase;
use Illuminate\Http\Response;
class UserControllerTests extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndexReturnsDataInValidFormat() {

        $this->json('get', 'api/students')
             ->assertStatus(Response::HTTP_OK)
             ->assertJsonStructure(
                 [
                     'data' => [
                         '*' => [
                             'id',
                             'name',
                             'course',
                             'created_at',
                             'updated_at'
                         ]
                     ]
                 ]
             );
      }

      public function testUserIsCreatedSuccessfully() {

        $payload = [
            'name' => $this->faker->firstName,
            'course'  => $this->faker->lastName,
        ];
        $this->json('post', 'api/students', $payload)
             ->assertStatus(Response::HTTP_CREATED)
             ->assertJsonStructure(
                 [
                     'data' => [
                         'id',
                         'name',
                         'course',
                         'created_at'
                     ]
                 ]
             );
        $this->assertDatabaseHas('users', $payload);
    }
}
