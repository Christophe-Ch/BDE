<?php

use Illuminate\Database\Seeder;

class CommentaireTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $date = new dateTime();

        DB::table('commentaires')->insert([
            "contenu" => "Cake icing chocolate cake croissant candy jujubes jujubes. Liquorice topping gingerbread bear claw cake. Biscuit muffin carrot cake apple pie chocolate bar chupa chups. Oat cake I love lemon drops sesame snaps topping.",
            "date" => $date,
            "user_id" => 1,
            "photo_id" => 1
        ]);
    }
}
