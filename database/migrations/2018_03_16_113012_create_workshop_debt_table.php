<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkshopDebtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshop_debt', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('workshop_id')->nullable()->unsigned()->index();//user_id
            $table->integer('order_id')->nullable()->unsigned()->index();
            $table->float('debt')->nullable();
            $table->float('paid')->nullable();
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
        Schema::dropIfExists('workshop_debt');
    }
}
