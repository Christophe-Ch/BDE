<?php

use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('articles')->insert([
            "nom" => "Bonnet",
            "description" => "Chocolate bar oat cake topping icing. Dragée I love cheesecake. Jelly-o chocolate bar dragée carrot cake sugar plum. Chocolate ice cream cookie marzipan I love icing lemon drops jelly-o danish.",
            "categorie" => 1,
            "prix" => 25,
            "photo" => "\url",
            "stock" => 100,
            "centre_id" => 1
        ]);
    }
}
