<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index){
            $temp = explode('/', $faker->image(public_path('/category')) );
            $imageName = end($temp);
            \App\Category::create([
                'name' => $faker->userName,
                'arrange' => $faker->randomNumber(1),
                'image'=> '/category/'.$imageName
            ]);
        }

    }
}
