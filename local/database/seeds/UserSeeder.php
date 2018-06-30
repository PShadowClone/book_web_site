<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,50) as $index){
            \App\User::create([
                'name' => $faker->userName,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'status' => random_int(1,2),
                'single_company' => random_int(1,2),
                'type' => random_int(1,2),
                'instRate' => random_int(1,100),
                'company_id' => random_int(1,49),
                'password' => Hash::make('secret'),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()

            ]);
        }

    }
}
