<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradepairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('tradepairs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('coinone')->nullable();
            $table->string('cointwo')->nullable();
            $table->string('symbol')->nullable();
            $table->double('min_buy_price')->default(0);
            $table->double('min_buy_amount')->default(0);
            $table->double('min_sell_price')->default(0);
            $table->double('min_sell_amount')->default(0);
            $table->double('buy_trade')->default(0);
            $table->double('sell_trade')->default(0);
            $table->double('live_price')->default(0);
            $table->double('open')->nullable();
            $table->double('low')->nullable();
            $table->double('high')->nullable();
            $table->double('close')->nullable();
            $table->double('hrchange')->nullable();
            $table->double('hrvolume')->nullable();
            $table->double('minprice')->nullable();
            $table->double('maxprice')->nullable();
            $table->double('ticksize')->nullable();
            $table->double('minqty')->nullable();
            $table->double('maxqty')->nullable();
            $table->double('stepsize')->nullable();
            $table->double('minnotional')->nullable();
            $table->integer('coinone_decimal')->default(8);
            $table->integer('cointwo_decimal')->default(8);
            $table->integer('active')->nullable();
            $table->integer('is_spot')->default(1);
            $table->integer('is_dust')->default(0);
            $table->integer('is_market')->default(1);
            $table->integer('orderlist')->nullable();
            $table->integer('type')->default(0);
            $table->double('start_buy_price')->default(0);
            $table->double('end_buy_price')->default(0);
            $table->double('start_sell_price')->default(0);
            $table->double('end_sell_price')->default(0);
            $table->double('start_volume')->default(0);
            $table->double('end_volume')->default(0);
            $table->double('is_bot')->default(0);
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
        Schema::dropIfExists('tradepairs');
    }
}
