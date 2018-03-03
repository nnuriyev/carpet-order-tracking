<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->renameColumn('paid_amount', 'paid_cash');
            $table->float('paid_terminal')->after('paid_amount');
            $table->float('paid_online')->after('paid_amount');
            $table->float('product_cost')->after('case_id');
            $table->float('frame_cost')->after('product_cost');
            $table->float('case_cost')->after('frame_cost');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
