<?php

use Illuminate\Database\Seeder;

class BookLikesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 50) as $index) {
            \App\BookFavourite::create([
                'client_id' => random_int(10, 49),
                'book_id' => random_int(10, 49)

            ]);
        }
    }
}
