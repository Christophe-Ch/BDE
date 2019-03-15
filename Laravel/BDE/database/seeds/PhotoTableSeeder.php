<?php

use Illuminate\Database\Seeder;

class PhotoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('photos')->insert([
            "url" => "photo.png",
            "manifestation_id" => 1,
            "user_id" => 1
        ]);
    }
}
