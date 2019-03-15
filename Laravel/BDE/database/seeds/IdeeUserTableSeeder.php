<?php

use Illuminate\Database\Seeder;

class IdeeUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('idee_user')->insert([
            "idee_id" => 1,
            "user_id" => 1
        ]);
    }
}
