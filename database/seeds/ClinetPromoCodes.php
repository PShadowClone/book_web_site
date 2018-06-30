<?php

use Illuminate\Database\Seeder;

class ClinetPromoCodes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach (range(0, 50) as $index) {
            \Illuminate\Support\Facades\DB::table('client_promocodes')->insert([
                'client_id' => random_int(5, 49),
                'promo_id' => random_int(1, 4),
            ]);
        }
    }
}
