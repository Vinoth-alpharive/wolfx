<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptiontradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('optiontrades');
        Schema::create('optiontrades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('uid');
            $table->enum('type',['High','Low'])->nullable();
            $table->string('order_id')->nullable();
            $table->integer('pair')->nullable();
            $table->double('amount')->nullable();
            $table->string('time_slot')->nullable();
            $table->double('open_price')->nullable();
            $table->double('close_price')->nullable();
            $table->double('payout')->nullable();
            $table->double('profit')->nullable();
            $table->double('difference')->nullable();
            $table->integer('status')->nullable();
            $table->string('status_text')->nullable();
            $table->integer('biding_status')->nullable();
            $table->double('winning_percentage')->nullable();
            $table->dateTime('expiry_time')->nullable();
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
        Schema::dropIfExists('optiontrades');
    }
}
