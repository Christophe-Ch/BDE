<?php

use Illuminate\Database\Seeder;

class ArticleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('article_user')->insert([
            "article_id" => 1,
            "user_id" => 1,
            "quantite" => 50
        ]);
    }
}
