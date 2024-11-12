<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IeoTrans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('ieo_trans');
        Schema::create('ieo_trans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('uid');
            $table->foreign('uid')->references('id')->on('users')->onDelete('cascade');
            $table->string('coinone')->nullable();
            $table->string('cointwo')->nullable();
            $table->string('trans_id')->nullable();
            $table->double('volume')->nullable();
            $table->double('price')->nullable();
            $table->double('total')->nullable();
            $table->string('status')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ieo_trans');
    }
}
