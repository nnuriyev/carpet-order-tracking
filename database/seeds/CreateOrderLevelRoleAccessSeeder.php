<?php

use Illuminate\Database\Seeder;

class CreateOrderLevelRoleAccessSeeder extends Seeder
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
                'order_level_id' => 1,
                'access'=> 2
            ],
            [
                'role_id' => 1,
                'order_level_id' => 2,
                'access'=> 2
            ],
            [
                'role_id' => 1,
                'order_level_id' => 3,
                'access'=> 2
            ],
            [
                'role_id' => 1,
                'order_level_id' => 4,
                'access'=> 2
            ],
            [
                'role_id' => 1,
                'order_level_id' => 5,
                'access'=> 2
            ],
            [
                'role_id' => 1,
                'order_level_id' => 6,
                'access'=> 2
            ],
            [
                'role_id' => 1,
                'order_level_id' => 7,
                'access'=> 2
            ],
            [
                'role_id' => 1,
                'order_level_id' => 8,
                'access'=> 2
            ],
            [
                'role_id' => 1,
                'order_level_id' => 9,
                'access'=> 2
            ],
            [
                'role_id' => 1,
                'order_level_id' => 10,
                'access'=> 2
            ],
            [
                'role_id' => 1,
                'order_level_id' => 11,
                'access'=> 2
            ],

            //sales acsess
            [
                'role_id' => 2,
                'order_level_id' => 1,
                'access'=> 1
            ],
            [
                'role_id' => 2,
                'order_level_id' => 2,
                'access'=> 1
            ],
            [
                'role_id' => 2,
                'order_level_id' => 3,
                'access'=> 0
            ],
            [
                'role_id' => 2,
                'order_level_id' => 4,
                'access'=> 1
            ],
            [
                'role_id' => 2,
                'order_level_id' => 6,
                'access'=> 0
            ],
            [
                'role_id' => 2,
                'order_level_id' => 7,
                'access'=> 2
            ],
            [
                'role_id' => 2,
                'order_level_id' => 8,
                'access'=> 2
            ],
            [
                'role_id' => 2,
                'order_level_id' => 9,
                'access'=> 2
            ],
            [
                'role_id' => 2,
                'order_level_id' => 10,
                'access'=> 2
            ],
            [
                'role_id' => 2,
                'order_level_id' => 11,
                'access'=> 1
            ],

            //workshop access
            [
                'role_id' => 3,
                'order_level_id' => 1,
                'access'=> 0
            ],
            [
                'role_id' => 3,
                'order_level_id' => 2,
                'access'=> 0
            ],
            [
                'role_id' => 3,
                'order_level_id' => 3,
                'access'=> 1
            ],
            [
                'role_id' => 3,
                'order_level_id' => 4,
                'access'=> 0
            ],
            [
                'role_id' => 3,
                'order_level_id' => 5,
                'access'=> 2
            ],
            [
                'role_id' => 3,
                'order_level_id' => 6,
                'access'=> 1
            ]

        ]);
    }
}
