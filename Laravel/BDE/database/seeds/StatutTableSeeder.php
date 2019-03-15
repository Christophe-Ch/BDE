<?php

use Illuminate\Database\Seeder;

class StatutTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('statuts')->insert([
            "nom" => "Salariés"
        ]);

        DB::table('statuts')->insert([
            "nom" => "BDE"
        ]);

        DB::table('statuts')->insert([
            "nom" => "Etudiants"
        ]);
    }
}
