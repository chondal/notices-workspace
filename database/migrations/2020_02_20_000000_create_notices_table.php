<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices_workspaces', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('body')->nullable();
            $table->string('color')->nullable();
            $table->timestamp('desde')->nullable();
            $table->timestamp('hasta')->nullable();
            $table->string('link')->nullable();
            $table->string('seccion')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('notices_workspaces');
    }
}
