<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('vakken', function (Blueprint $table) {
            $table->increments('id');
            $table->string("naam");
            $table->string("opleiding");
            $table->integer("semester");
            $table->time("duur");
            $table->integer("sessies");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('vakken');
    }
};
