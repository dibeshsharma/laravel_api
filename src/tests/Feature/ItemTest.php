<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UsersTest extends TestCase
{
    // /**
    //  * A basic test example.
    //  *
    //  * @return void
    //  */
    // public $faker;

    // public function __construct()
    // {
    //     $faker = \Faker\Factory::create();
    // }

    // public function testExample()
    // {
    //     $this->assertTrue(true);
    // }

    public function test_must_contain_name_and_email()
    {
        $response = $this->postJson('/api/users', ['name' => '', 'email' => '']);
        $response
            ->assertStatus(400)
            ->assertJson([                
                "message" => "Form Errors."
            ]);

    }

    public function test_api_can_add()
    {
    	$faker = \Faker\Factory::create();
        $response = $this->postJson('/api/users', ['name' => $faker->name, 'email' => $faker->unique()->email]);

        $response
            ->assertStatus(201)
            ->assertJson([
            	"message" => "Registered successfully."
        ]);            
    }

    public function test_api_can_update()
    {
    	$faker = \Faker\Factory::create();        
        $user = User::create([
            'name'  => $faker->name,
            'email' => $faker->unique()->email,
        ]);

        $response = $this->putJson('/api/users/'.$user->id, ['name' => 'Sally', 'email' => $faker->unique()->email]);

        $response
            ->assertStatus(200)
            ->assertJson([
            	"message" => "Updated successfully."
        ]);
    }

    public function test_api_can_delete()
    {
    	$faker = \Faker\Factory::create();        
        $user = User::create([
            'name'  => $faker->name,
            'email' => $faker->unique()->email,
        ]);
    	
        $response = $this->deleteJson('/api/users/'. $user->id);
    	$response
            ->assertStatus(204);
    }
}
