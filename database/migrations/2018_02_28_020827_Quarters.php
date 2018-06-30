<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
const TABLE_QUARTERS = 'quarters';
class Quarters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(TABLE_QUARTERS, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('cityId')->unsigned();
            $table->integer('area_id')->unsigned();
            $table->string('englishName')->nullable();
            $table->timestamps();
            $table->foreign('cityId')->references('id')->on('cities');
            $table->foreign('area_id')->references('id')->on('areas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(TABLE_QUARTERS);

    }
}
