<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->text('address');
            $table->string('district');
            $table->string('city');
            $table->string('country');
            $table->string('telno',15);
            $table->string('cepno',15);
            $table->string('web',60);
            $table->string('fburl',200);
            $table->string('twurl',200);
            $table->string('gourl',200);
            $table->text('about');
            $table->string('code',200);
            $table->tinyInteger('approve');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
