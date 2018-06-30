<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class RequestSeeder extends Seeder
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
           \App\Request::create([
               'client_id' => random_int(3,50),
               'driver_id' => random_int(3,50),
               'book_id' => random_int(3,50),
               'library_id' => random_int(3,50),
               'quarter_id' => random_int(3,50),
               'delivery_time' => $faker->dateTime,
               'status' => random_int(1,8),
               'book_amount' => random_int(1,100),
               'promo_code' => str_random(8),
               'request_identifier' => random_int(1,10000000),
               'latitude' => $faker->latitude,
               'longitude' => $faker->longitude
           ]);
       }
    }
}
