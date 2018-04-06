<?php

use Illuminate\Database\Seeder;

class CreateCancelOrderLevelAccess extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_level_role_access')->insert([

            //admin access
            [
                'role_id' => 1,
                'order_level_id' => 12,
                'access'=> 2
            ],
            //sales access
            [
            'role_id' => 2,
            'order_level_id' => 12,
            'access'=> 2
        ]
        ]);
    }
}
