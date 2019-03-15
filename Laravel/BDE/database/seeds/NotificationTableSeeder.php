<?php

use Illuminate\Database\Seeder;

class NotificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('notifications')->insert([
            "titre" => 'title du futur',
            "message" => "messages1",
            "date" => new DateTime(),
            "url" => '\url\url',
            "lue" => false,
            "user_id" => 1
        ]);
    }
}
