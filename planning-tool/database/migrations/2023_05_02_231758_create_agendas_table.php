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
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('vak_id');
            $table->foreign('vak_id')->references('id')->on('vakken')->onDelete('cascade');
            $table->date('datum');
            $table->time('beginuur');
            $table->time('einduur');
            $table->string('lokaal');
            $table->string('leerkracht');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('agendas');
    }
};
