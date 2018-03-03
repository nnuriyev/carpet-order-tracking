<?php

use Illuminate\Database\Seeder;

class FirstSAUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name'          => 'Nurlan Nuriyev',
                'email'         => 'nnuriyev6@gmail.com',
                'password'      => bcrypt('s3cr3t'),
            ]
        ]);
    }
}
