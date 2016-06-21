<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFackerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fackers', function (Blueprint $table) {
            $table->increments('id_school');
            $table->string('name_school');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);

            $table->integer('id_parent'); //
            $table->integer('id_school_parent');
            $table->string('name_parent');

            $table->integer('id_kid'); //
            $table->string('name_kid');
            $table->integer('id_kid_parent'); //
            $table->string('age');
            $table->string('sex');

            $table->integer('id_behavior'); //
            $table->integer('id_behavior_kid'); //
            $table->integer('result')->unsigned();
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
       Schema::drop('fackers');
    }
}
