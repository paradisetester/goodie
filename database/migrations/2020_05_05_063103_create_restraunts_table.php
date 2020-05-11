<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestrauntsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restraunts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('uid');
            $table->string('restraunt_name');
            $table->integer('Assignuser');
            $table->integer('ratings');
            $table->integer('contact');
            $table->string('address');
            $table->string('image');
            $table->longText('description');
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
        Schema::dropIfExists('restraunts');
    }
}
