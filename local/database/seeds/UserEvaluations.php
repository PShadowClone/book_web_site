<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserEvaluations extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1,100) as $index){
            \App\UserEvaluations::create([
                'client_id' => random_int(1,49),
                'driver_id' => random_int(1,49),
                'request_id' => random_int(1,49),
                'book_id' => random_int(1,49),
                'evaluate' => $faker->randomFloat(2,0,5),
                'note' => $faker->paragraph,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
