<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 50) as $index) {
            \App\Company::create([
                'phone' => $faker->phoneNumber,
                'email' => $faker->email,
                'address' => $faker->address,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
