<?php

use Illuminate\Database\Seeder;

class ManifestationUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('manifestation_user')->insert([
            "user_id" => 1,
            "manifestation_id" => 1
        ]);
    }
}
