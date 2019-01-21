<?php

use Illuminate\Database\Seeder;

class ManifestationTableSeeder extends Seeder
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

        DB::table('manifestations')->insert([
            "nom" => "Manif_1",
            "description" => "Le futuuur",
            "date" => $date,
            "prix" => 0,
            "photo" => "photo.png",
            "centre_id" => 1
        ]);
    }
}
