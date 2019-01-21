<?php

use Illuminate\Database\Seeder;

class IdeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('idees')->insert([
            "nom" => "idee1",
            "description" => "une idee geniale",
            "vote" => 1,
            "user_id" => 1,
            "centre_id" => 1
        ]);
    }
}
