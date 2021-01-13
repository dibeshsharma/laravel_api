<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Items;

class ItemsTest extends TestCase
{
    // /**
    //  * A basic test example.
    //  *
    //  * @return void
    //  */
    
    public function test_must_contain_name_and_email()
    {
        $response = $this->postJson('/api/items', ['name' => '', 'email' => '']);
        $response
            ->assertStatus(400)
            ->assertJson([                
                "message" => "Form Errors."
            ]);

    }

    public function test_api_can_add()
    {
    	$faker = \Faker\Factory::create();
        $response = $this->postJson('/api/items', ['name' => $faker->name, 'email' => $faker->unique()->email]);

        $response
            ->assertStatus(201)
            ->assertJson([
            	"message" => "Registered successfully."
        ]);            
    }

    public function test_api_can_update()
    {
    	$faker = \Faker\Factory::create();        
        $item = Item::create([
            'name'  => $faker->name,
            'email' => $faker->unique()->email,
        ]);

        $response = $this->putJson('/api/items/'.$item->id, ['name' => 'Sally', 'email' => $faker->unique()->email]);

        $response
            ->assertStatus(200)
            ->assertJson([
            	"message" => "Updated successfully."
        ]);
    }

    public function test_api_can_delete()
    {
    	$faker = \Faker\Factory::create();        
        $item = Item::create([
            'name'  => $faker->name,
            'email' => $faker->unique()->email,
        ]);
    	
        $response = $this->deleteJson('/api/items/'. $item->id);
    	$response
            ->assertStatus(204);
    }
}
