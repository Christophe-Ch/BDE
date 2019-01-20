<?php

use Illuminate\Database\Seeder;

class PhotoUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('photo_user')->insert([
            "photo_id" => 1,
            "user_id" => 1
        ]);
    }
}
