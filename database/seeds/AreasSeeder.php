<?php

use Illuminate\Database\Seeder;

class AreasSeeder extends Seeder
{

    public function run()
    {
        \Illuminate\Support\Facades\DB::statement('
INSERT INTO areas (`name`) VALUES ("الباحة");
 
INSERT INTO areas (`name`) VALUES ("الجوف");
 
INSERT INTO areas (`name`) VALUES ("المدينة المنورة");
 
INSERT INTO areas (`name`) VALUES ("حائل");
 
INSERT INTO areas (`name`) VALUES ("جازان");
 
INSERT INTO areas (`name`) VALUES ("مكة المكرمة");
 
INSERT INTO areas (`name`) VALUES ("نجران");
 
INSERT INTO areas (`name`) VALUES ("الرياض");
 
INSERT INTO areas (`name`) VALUES ("تبوك");
 
INSERT INTO areas (`name`) VALUES ("عسير");
 
INSERT INTO areas (`name`) VALUES ("المنطقة الشرقية");
 
INSERT INTO areas (`name`) VALUES ("القصيم");
 
INSERT INTO areas (`name`) VALUES ("الحدود الشمالية");
 
');
    }
}
