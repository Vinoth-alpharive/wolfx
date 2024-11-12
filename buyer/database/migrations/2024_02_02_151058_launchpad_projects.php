<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LaunchpadProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('launchpad_projects');
        Schema::create('launchpad_projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('telegram_username')->nullable();
            $table->string('project_name')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('launchpad_projects');
        
    }
}
