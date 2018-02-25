<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderLevelRolePivotTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_level_role_access', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned()->nullable();
            $table->integer('order_level_id')->unsigned()->nullable()->index();
            $table->tinyInteger('access')->nullable(); // 0 => view; 1 => view&write;
            $table->timestamps();

            //RELATIONS
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('order_level_id')->references('id')->on('order_levels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_level_role_access');
    }
}
