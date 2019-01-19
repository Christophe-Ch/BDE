<?php

use Illuminate\Database\Seeder;

class AchatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('achats')->insert([
            "user_id" => 1,
            "article_id" => 1,
            "quantite" => 1
        ]);
    }
}
