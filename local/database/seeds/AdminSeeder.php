<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AdminSeeder extends Seeder
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
            \Illuminate\Support\Facades\DB::table('admins')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('secret'),
                'username' => $faker->userName,
                'type' => '0'
            ]);
        }
    }
}
