<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class Libraries extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(0,50)  as $index){
            \Illuminate\Support\Facades\DB::table('libraries')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('secret'),
                'status' => random_int(1,2),
                'phone' => $faker->phoneNumber,
                'mobile' => $faker->phoneNumber,
                'longitude' =>  $faker->longitude,
                'latitude' =>  $faker->latitude,
                'address' =>  $faker->address,
                'quarter_id' => random_int(8,2235),
                'instProfitRate' =>$faker->randomFloat(2,1,100),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
