<?php

use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(AdminSeeder::class);
//        $this->call(Libraries::class);
//        $this->call(CompaniesSeeder::class);
//        $this->call(UserSeeder::class);
//        $this->call(UserEvaluations::class);
//        $this->call(CategorySeeder::class);
//        $this->call(BookSeeder::class);
//        $this->call(RequestSeeder::class);
//        $this->call(Ads::class);

        $this->call(ClinetPromoCodes::class);
    }
}
