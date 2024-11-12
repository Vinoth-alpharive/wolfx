<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('match_histories');
        Schema::create('match_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('pair')->default(0);
            $table->integer('buytrade_id')->default(0);
            $table->integer('selltrade_id')->default(0);
            $table->double('price')->default(0);
            $table->double('volume')->default(0);
            $table->double('value')->default(0);
            $table->string('type')->nullable();
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
        Schema::dropIfExists('match_histories');
    }
}
