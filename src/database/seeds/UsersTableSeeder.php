<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for($i=0; $i<4; $i++){
        	User::create([
        		'name' 	=> $faker->name,
        		'email' => $faker->unique()->email,
        	]);
        }        
    }
}
