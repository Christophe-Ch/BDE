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
            [
                "nom" => "Bonnet",
                "description" => "Chocolate bar oat cake topping icing. Dragée I love cheesecake. Jelly-o chocolate bar dragée carrot cake sugar plum. Chocolate ice cream cookie marzipan I love icing lemon drops jelly-o danish.",
                "categorie" => 1,
                "prix" => 25,
                "photo" => "\url",
                "stock" => 100,
                "achat" => 50,
                "centre_id" => 1  
            ],

            [
                "nom" => "Pull",
                "description" => "Cupcake soufflé tiramisu marshmallow sweet lemon drops. Sweet roll dessert ice cream cheesecake. Pastry chocolate bar gummi bears cake chupa chups danish sweet roll croissant sugar plum.",
                "categorie" => 1,
                "prix" => 30,
                "photo" => "\url",
                "stock" => 100,
                "achat" => 150,
                "centre_id" => 1 
            ],

            [
                "nom" => "Porte clés",
                "description" => "Cupcake soufflé tiramisu marshmallow sweet lemon drops. Sweet roll dessert ice cream cheesecake. Pastry chocolate bar gummi bears cake chupa chups danish sweet roll croissant sugar plum.",
                "categorie" => 2,
                "prix" => 10,
                "photo" => "\url",
                "stock" => 100,
                "achat" => 20,
                "centre_id" => 1 
            ]
            
        ]);
    }
}
