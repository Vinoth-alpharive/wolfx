<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarginWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('margin_wallets');
        Schema::create('margin_wallets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('uid');
            $table->foreign('uid')->references('id')->on('users')->onDelete('cascade');
            $table->text('mukavari')->nullable();
            $table->string('currency')->nullable();
            $table->text('payment_id')->nullable();
            $table->double('balance')->default(0);
            $table->double('escrow_balance')->default(0);
            $table->double('site_balance')->default(0);
            $table->double('borrow_balance')->default(0);
            $table->double('receive')->default(0);
            $table->double('spend')->default(0);
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
        Schema::dropIfExists('margin_wallets');
    }
}
