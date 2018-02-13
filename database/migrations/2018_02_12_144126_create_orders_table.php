<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('customer_id')->unsigned()->nullable()->index();
            $table->integer('product_id')->unsigned()->nullable()->index();
            $table->integer('frame_id')->unsigned()->nullable();
            $table->integer('case_id')->unsigned()->nullable();
            $table->float('price');
            $table->float('paid_amount');
            $table->float('discount_amount')->default(0);
            $table->tinyInteger('status'); // 0 => Tesdiq olunmayib; 1 => Tesdiq olunub; 2 => Sifaris tamamlanib
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();

            //RELATIONS
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
            $table->foreign('frame_id')->references('id')->on('products')->onDelete('set null');
            $table->foreign('case_id')->references('id')->on('products')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
