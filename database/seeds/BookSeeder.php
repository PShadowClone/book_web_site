<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
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
            $temp = explode('/', $faker->image(public_path('/book')));
            $imageName = end($temp);
            \App\Book::create([
                'name' => $faker->name,
                'arrange' => random_int(1, 100),
                'library_id' => random_int(1, 49),
                'category_id' => random_int(1, 49),
                'writer' => $faker->name,
                'publisher' => $faker->name,
                'publish_date' => $faker->date('m/d/y'),
                'description' => $faker->paragraph,
                'image' => '/book/' . $imageName,
                'price' => $faker->randomFloat(2),
                'inquisitor' => $faker->name,
                'amount' => $faker->randomNumber(3)

            ]);

        }

    }
}
