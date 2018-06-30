<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class Ads extends Seeder
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
            $temp = explode('/', $faker->image(public_path('/'.ADS_DIR)));
            $adsImage = end($temp);
            \Illuminate\Support\Facades\DB::table('advertisements')->insert([
                'content' => $faker->paragraph(3),
                'arrange' => random_int(0,100),
                'image' => '/'.ADS_DIR.'/' . $adsImage,
                'contact_phone' => $faker->phoneNumber,
                'start_publish' =>$faker->date("Y-m-d"),
                "end_publish" => $faker->date("Y-m-d"),
            ]);
        }
    }
}
