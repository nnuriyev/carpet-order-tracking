<?php

use Illuminate\Database\Seeder;

class CreateCancelOrderLevel extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_levels')->insert([
            [
                'name' => 'Ləğv et',
                'key' => 'cancel'
            ]
        ]);
    }
}
