<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('title');
            $table->text('detail');
            $table->tinyInteger('type');
            $table->tinyInteger('period')->nullable();
            $table->decimal('price',15,2);
            $table->double('area',15,2);
            $table->double('gardenarea',15,2);
            $table->integer('room');
            $table->integer('bathroom');
            $table->tinyInteger('furniture')->default(0);
            $table->tinyInteger('detached')->default(0);
            $table->tinyInteger('insite')->default(0);
            $table->tinyInteger('garden')->default(0);
            $table->tinyInteger('pool')->default(0);
            $table->tinyInteger('kidspool')->default(0);
            $table->tinyInteger('seenpool')->default(0);
            $table->tinyInteger('garage')->default(0);
            $table->integer('seadistance');
            $table->string('address');
            $table->string('district');
            $table->string('city');
            $table->string('country');
            $table->tinyInteger('approve')->default(0);
            $table->integer('views')->default(0);
            $table->integer('favorites')->default(0);
            $table->dateTime('expiration_at');
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
        Schema::dropIfExists('properties');
    }
}
