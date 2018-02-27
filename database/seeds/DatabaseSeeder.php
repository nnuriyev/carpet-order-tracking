<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(FirstSAUserSeeder::class);
        $this->call(CreateRolesSeeder::class);
        $this->call(CreateOrderLevelsSeeder::class);
    }
}
