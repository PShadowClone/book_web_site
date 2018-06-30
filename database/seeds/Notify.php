<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class Notify extends Seeder
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
            \Illuminate\Support\Facades\DB::table('notifications')->insert([
                'admin_id' => random_int(1,30),
                'type' => random_int(1,3),
                'type_all' =>  random_int(1,2),
                'content' => $faker->paragraph(3),
                'to' => random_int(1,30)
            ]);
        }
    }
}
