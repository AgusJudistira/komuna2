<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i=0; $i < 100; $i++) {
            App\User::create([
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'password' => $faker->password,
                'email' => $faker->unique()->email,
                'streetname_number' => $faker->streetAddress,
                'postal_code' => $faker->postcode,
                'city' => $faker->city
            ]);
        }
        
    }
}
