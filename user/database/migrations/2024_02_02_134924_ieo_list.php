<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IeoList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('ieo_list');
        Schema::create('ieo_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('symbol')->nullable();
            $table->string('cointwo')->nullable();
            $table->integer('stage')->nullable()->default(1);
            $table->string('protocol_network')->nullable();
            $table->string('website')->nullable();
            $table->text('description')->nullable();
            $table->string('industry')->nullable();
            $table->integer('supply_per_session')->nullable();
            $table->double('price_in_cointwo')->nullable();
            $table->double('min_token_purchase')->nullable();
            $table->double('min_othercurrency_purchase')->nullable();
            $table->string('pair_currencies')->nullable()->default('USDT');
            $table->double('discount')->nullable()->default(0);
            $table->double('roi')->nullable()->default(0);
            $table->string('whitepaper')->nullable();
            $table->string('presentation')->nullable();
            $table->string('socialmedia')->nullable();
            $table->string('banner')->nullable();
            $table->string('logo')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('ieo_list');
    }
}
